<?php

namespace App\Http\Controllers\API;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Clinic;
use App\Models\Fisioterapis;
use App\Models\Schedule;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->user()->city;
        $fisioterapis = Fisioterapis::with('images', 'schedules')
            ->select([
                'fisioterapis_id',
                'name',
                'address',
                'village',
                'district',
                'city',
                'province',
                'about',
                'price',
                'photo',
            ])->whereCity($city)->get();
        return response()->json([
            'data' => $fisioterapis
        ]);
    }
    public function booking($id)
    {
        $fisioterapis = Fisioterapis::where('fisioterapis_id','=',$id)->with('booking','schedules')
            ->select([
                'fisioterapis_id',
                'name',
                'address',
                'village',
                'district',
                'city',
                'province',
                'about',
                'price',
                'photo',
            ])->get();
        return response()->json([
            'data' => $fisioterapis
        ]);
    }

    public function show(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date_format:Y-m-d',
            'type' => 'nullable'
        ]);

        if ($request->type) {
            if ($request->type != 'online' && $request->type != 'offline') {
                return response()->json([
                    'message' => 'Tipe tidak tersedia'
                ], 404);
            }
        }
        $type = $request->type ? ucfirst($request->type) : 'Offline';

        $fisioterapis = Fisioterapis::find($id);
        if (empty($fisioterapis)) {
            return response()->json([
                'message' => 'Fisioterapis tidak ditemukan'
            ], 404);
        }

        $day_num = date('N', strtotime($request->date));
        $day = GlobalHelper::getDayName($day_num - 1);

        $schedule = Schedule::with('bookings')
            ->where('day', $day)
            ->whereFisioterapisId($id)
            ->whereType($type)
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => 'Tidak ada jadwal untuk tanggal ini'
            ], 404);
        }

        $data = [
            'type' => $type,
            'bookings' => $schedule->bookings
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'type' => 'required'
        ]);

        if ($request->type != 'online' && $request->type != 'offline') {
            return response()->json([
                'message' => 'Tipe tidak tersedia'
            ], 404);
        }
        $type = ucfirst($request->type);

        $date = date('Y-m-d');
        $now = date('H:i:s');

        // cek tanggal booking harus hari ini atau selanjutnya
        if ($request->date < $date) {
            return response()->json([
                'message' => 'Tidak bisa booking di tanggal sebelum hari ini'
            ], 404);
        }

        $limit = date('H:i:s', strtotime('+1 hour', strtotime($now)));

        $fisioterapis = Fisioterapis::find($id);
        if (empty($fisioterapis)) {
            return response()->json([
                'message' => 'Fisioterapis tidak ditemukan'
            ], 404);
        }

        $start = $request->time . ':00';
        $end = date("H:i:s", strtotime('+30 minutes', strtotime($start)));

        $day_num = date('N', strtotime($request->date));
        $day = GlobalHelper::getDayName($day_num - 1);

        // cek jika jadwal ada
        $schedule = Schedule::with('bookings')
            ->where(function ($query) use ($start) {
                $query->where('from', '<=', $start);
                $query->where('to', '>=', $start);
            })
            ->Where(function ($query) use ($end) {
                $query->where('from', '<=', $end);
                $query->where('to', '>=', $end);
            })
            ->where('day', $day)
            ->whereType($type)
            ->whereFisioterapisId($id)->first();

        if (empty($schedule)) {
            return response()->json([
                'message' => 'Diluar jadwal'
            ], 404);
        }

        // cek waktu booking harus 1 jam sebelum buka
        if ($date == $request->date) {
            $time_now = date('H:i:s');

            if ($time_now > $schedule->from) {
                return response()->json([
                    'message' => 'Tidak bisa booking di saat sudah jam buka'
                ], 404);
            }

            if ($limit >= $schedule->from) {
                return response()->json([
                    'message' => 'Tidak bisa booking 1 jam sebelum jam buka'
                ], 404);
            }
        }

        // cek ketersediaan booking

        $start_limit = date('H:i:s', strtotime('-10 minutes', strtotime($start)));
        $end_limit = date('H:i:s', strtotime('+10 minutes', strtotime($end)));

        if ($schedule->bookings) {
            $exixst = Booking::whereScheduleId($schedule->schedule_id)
                ->where(function ($query) use ($start_limit) {
                    $query->where('start', '<=', $start_limit);
                    $query->where('end', '>=', $start_limit);
                })
                ->orWhere(function ($query) use ($end_limit) {
                    $query->where('start', '<=', $end_limit);
                    $query->where('end', '>=', $end_limit);
                })
                ->exists();
            if ($exixst) {
                return response()->json([
                    'message' => 'Sudah di booking orang lain'
                ], 404);
            }
        }

        $booking = $schedule->bookings()->create([
            'user_id' => $request->user()->user_id,
            'price'   => $type == 'Offline' ? $fisioterapis->price : 0,
            'date'    => $request->date,
            'start'   => $start,
            'end'     => $end,
            'status'  => 'Submit',
        ]);

        return response()->json([
            'data' => $booking,
            'message' => 'Berhasil booking'
        ]);
    }
}

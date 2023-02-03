<?php

namespace App\Http\Controllers\Api\v2;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Fisioterapis;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date_format:Y-m-d',
        ]);

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
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => 'Tidak ada jadwal untuk tanggal ini'
            ], 404);
        }
        $start = $schedule->from;
        $end = $schedule->to;

        $data = [];
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;
        while ($tNow <= $tEnd) {
            $current = date('H:i', $tNow);

            $check = Booking::query()
                ->whereScheduleId($schedule->schedule_id)
                ->whereDate($request->date)
                ->whereStart($current)
                ->exists();

            $data[] = [
                'time' => $current,
                'available' => !$check
            ];
            $tNow = strtotime('+30 minutes', $tNow);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'type' => 'required',
            'reason' => 'required',
            'insurance' => 'required',
            'visit' => 'required',
            'payment_process' => 'required',
        ]);

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
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => 'Tidak ada jadwal untuk tanggal ini'
            ], 404);
        }

        $check = Booking::query()
            ->whereScheduleId($schedule->schedule_id)
            ->whereDate($request->date)
            ->whereStart($request->time)
            ->exists();

        if ($check) {
            return response()->json([
                'message' => 'Sudah di booking orang lain'
            ], 404);
        }
    }
}

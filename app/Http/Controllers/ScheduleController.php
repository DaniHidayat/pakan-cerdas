<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\Fisioterapis;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.fisioterapis.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fisio_id)
    {
        $fisio = Fisioterapis::findOrFail($fisio_id);
        $days = GlobalHelper::days();
        $types = GlobalHelper::types();
        return view('admin.fisioterapis.schedule.create', compact('fisio', 'days', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $fisio_id)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'type' => 'required',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:from',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.fisioterapis.schedule.create', $fisio_id)->with('error', $validator->errors()->first())->withInput();
        }

        $fisio = Fisioterapis::findOrFail($fisio_id);

        $fisio->schedules()->create([
            'day' => $request->day,
            'type' => $request->type,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->route('admin.fisioterapis.show', $fisio_id)->with('success', 'Jadwal berhasil ditambahkan')->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fisio_id, $id)
    {
        $days = GlobalHelper::days();
        $types = GlobalHelper::types();
        $fisio = Fisioterapis::findOrFail($fisio_id);
        $schedule = $fisio->schedules()->findOrFail($id);
        return view('admin.fisioterapis.schedule.edit', compact('days', 'types', 'fisio', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fisio_id, $id)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'type' => 'required',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:from',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.fisioterapis.schedule.edit', ['fisioterapi' => $fisio_id, 'schedule' => $id])->with('error', $validator->errors()->first())->withInput();
        }

        $fisio = Fisioterapis::findOrFail($fisio_id);
        $schedule = $fisio->schedules()->findOrFail($id);
        $schedule->update([
            'day' => $request->day,
            'type' => $request->type,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->route('admin.fisioterapis.show', $fisio_id)->with('success', 'Jadwal berhasil diedit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($fisio_id, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('admin.fisioterapis.show', $fisio_id)->with('success', 'Jadwal berhasil dihapus')->withInput();
    }
}

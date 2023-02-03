<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->user()->city;
        $clinics = Clinic::select([
            'clinic_id',
            'name',
            'address',
            'village',
            'district',
            'city',
            'province',
            'image',
        ])->whereCity($city)->get();
        return response()->json([
            'data' => $clinics
        ]);
    }

    public function show(Request $request, $id)
    {
        $clinic = Clinic::with('schedules')->find($id);
        if (empty($clinic)) {
            return response()->json([
                'message' => 'Klinik tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => $clinic
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'birth_date' => 'required|date_format:Y-m-d',
            'village'    => 'required',
            'district'   => 'required',
            'city'       => 'required',
            'province'   => 'required',
            'gender'     => 'required',
            'phone'      => 'required',
            'email'      => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'height'     => 'required',
            'weight'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $user->update(
            $request->only([
                'name',
                'birth_date',
                'address',
                'village',
                'district',
                'city',
                'province',
                'gender',
                'phone',
                'email',
                'height',
                'weight',
            ])
        );

        return response()->json([
            'message' => 'Profil berhasil diubah',
            'data' => $user
        ]);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:png,jpg',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();
            move_uploaded_file($file, public_path('uploads/photo') . '/' . $name);
        }

        $user = $request->user();
        $user->update([
            'photo' => $name
        ]);

        return response()->json([
            'message' => 'Foto Profil berhasil diupload',
            'data' => $user->photo_url
        ]);
    }
}

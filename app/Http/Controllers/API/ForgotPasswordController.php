<?php

namespace App\Http\Controllers\API;

use App\Helpers\Random;
use App\Http\Controllers\Controller;
use App\Mail\OtpEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $otp = Random::otp();

        $user = User::whereEmail($request->email)->first();
        $user->update([
            'otp' => $otp
        ]);

        Mail::to($request->email)->send(new OtpEmail($user->name, $otp));

        return response()->json([
            'message' => 'Kode OTP untuk reset password sudah dikirim ke email anda'
        ]);
    }

    public function otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $user = User::whereEmail($request->email)->first();

        if ($request->otp != $user->otp) {
            return response()->json([
                'message' => 'Kode OTP salah'
            ], 403);
        }

        return response()->json([
            'message' => 'Kode OTP benar'
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:4',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $user = User::whereEmail($request->email)->first();

        if ($request->otp != $user->otp) {
            return response()->json([
                'message' => 'Kode OTP salah'
            ], 403);
        }

        $user->update([
            'otp' => null,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Password akun anda berhasil direset'
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fisioterapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        if ($request->password != $request->password_confirm) {
            return response()->json(['message' => "Password not match"], 401);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        // if (!Auth::attempt($request->only('email', 'password')))
        // {
        //     return response()
        //         ->json(['message' => 'Unauthorized'], 401);
        // }
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $user = User::where('email', $request->email)->first();
        $access = 'User';
        if (!$user) {
            $user = Fisioterapis::whereEmail($request->email)->first();
            $access = 'Fisioterapis';
            if (!$user) {
                return response()->json(['message' => 'Akun tidak ditemukan'], 401);
            }
        }

        if (!\Hash::check($request->password, $user->password, [])) {
            return response()->json(['message' => 'Password salah'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message' => 'Hi ' . $user->name . ', welcome to home',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'access' => $access,
            ], 200);
    }
    public function detail()
    {
        $user = User::where('user_id', '=', auth()->user()->user_id)->first();
        return response()->json(['data' => $user]);
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}

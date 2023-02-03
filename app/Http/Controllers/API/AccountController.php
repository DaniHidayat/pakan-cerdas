<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $users = User::select('name', 'email', 'photo')
            ->where('user_id', '!=', $user->user_id)
            ->get();
        $users = $users->makeHidden('photo_url');
        return response()->json([
            'data' => $users
        ]);
    }
}

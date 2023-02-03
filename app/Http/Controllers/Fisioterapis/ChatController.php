<?php

namespace App\Http\Controllers\Fisioterapis;

use App\Http\Controllers\Controller;
use App\Http\Resources\Fisioterapis\ChatCollection;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $bookings = $user->online_bookings;
        return response()->json([
            'data' => new ChatCollection($bookings)
        ]);
    }
}

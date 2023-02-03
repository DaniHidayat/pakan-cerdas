<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatCollection;
use App\Models\Booking;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $bookings = Booking::with('fisioterapis')
            ->whereHas('schedule', function ($q) {
                $q->whereType('Online');
            })
            ->whereUserId($user->user_id)->get();
        return response()->json([
            'data' => new ChatCollection($bookings)
        ]);
    }
}

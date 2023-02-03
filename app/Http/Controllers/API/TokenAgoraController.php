<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TokenAgora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
class TokenAgoraController extends Controller
{
    public function index()
    {
        $data = TokenAgora::first();
        return response()->json([
            'data' => $data
        ]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'token'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $data = [
            'name' => $request->name,
            'token' => $request->token,
        ];
        $result = TokenAgora::where('token_id', '=', 1)->update($data);
        return response()->json([
            'msg' => 'berhasil di ubah', 'data' => $data
        ]);
    }
}

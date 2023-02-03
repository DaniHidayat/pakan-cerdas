<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Fisioterapis;
use App\Models\Image;
use Ramsey\Uuid\Uuid;

class FisioterapisController extends Controller
{
    public function index()
    {
        $fisioterapis = Fisioterapis::all();
        // return view('admin.fisioterapis.index', compact('fisioterapis'));
        return $fisioterapis;
    }
    public function show($id){
        $data = Fisioterapis::where('fisioterapis_id','=',$id)->first();
        return $data;
    }
}

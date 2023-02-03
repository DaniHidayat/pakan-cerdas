<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();
        return view('admin.price.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = GlobalHelper::types();
        return view('admin.price.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.price.create')->with('error', $validator->errors()->first())->withInput();
        }

        Price::create([
            'name' => $request->name,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.price.index')->with('success', 'Biaya berhasil ditambahkan')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = Price::findOrFail($id);
        return view('admin.price.show', compact('price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $price = Price::findOrFail($id);
        $types = GlobalHelper::types();
        return view('admin.price.edit', compact('price', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.price.edit', $id)->with('error', $validator->errors()->first())->withInput();
        }

        $price = Price::findOrFail($id);
        $price->update([
            'name' => $request->name,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.price.index')->with('success', 'Biaya berhasil diedit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();
        return redirect()->route('admin.price.index')->with('success', 'Biaya berhasil dihapus')->withInput();
    }
}

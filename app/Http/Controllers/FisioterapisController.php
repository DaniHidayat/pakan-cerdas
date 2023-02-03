<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapis;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class FisioterapisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fisioterapis = Fisioterapis::all();
        return view('admin.fisioterapis.index', compact('fisioterapis'));
    }

    public function getImages($id)
    {
        $fisio = Fisioterapis::findOrFail($id);
        $fisio_images = $fisio->images;
        $images = [];
        foreach ($fisio_images as $image) {
            $images[] = [
                'id' => $image->image_id,
                'src' => $image->image_url
            ];
        }

        return response()->json($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fisioterapis.create');
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
            'name'     => 'required',
            'email'    => 'required|email|unique:fisioterapis,email',
            'password' => 'required|confirmed|min:8',
            'phone'    => 'required',
            'address'  => 'required',
            'village'  => 'required',
            'district' => 'required',
            'city'     => 'required',
            'province' => 'required',
            'photo'    => 'required|mimes:png,jpg',
            'price'    => 'nullable',
            'about'    => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.fisioterapis.create')->with('error', $validator->errors()->first())->withInput();
        }

        if (!$request->file('images')) {
            return redirect()->route('admin.fisioterapis.create')->with('error', 'Galeri minimal satu')->withInput();
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Uuid::uuid4() . '.' . $file->extension();
            move_uploaded_file($file, public_path('uploads/fisioterapis') . '/' . $name);
        }

        $fisio = Fisioterapis::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
            'village'  => $request->village,
            'district' => $request->district,
            'city'     => $request->city,
            'province' => $request->province,
            'price'    => $request->price,
            'photo'    => $name,
            'price'    => $request->price,
            'about'    => $request->about,
        ]);

        foreach ($request->file('images') as $image) {
            $name = Uuid::uuid4() . '.' . $image->extension();
            move_uploaded_file($image, public_path('uploads/image') . '/' . $name);
            $fisio->images()->create([
                'image' => $name
            ]);
        }

        return redirect()->route('admin.fisioterapis.index')->with('success', 'Fisioterapis berhasil ditambahkan')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fisio = Fisioterapis::findOrFail($id);
        return view('admin.fisioterapis.show', compact('fisio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fisio = Fisioterapis::findOrFail($id);
        return view('admin.fisioterapis.edit', compact('fisio'));
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
            'name'     => 'required',
            'email'    => 'required|email|unique:fisioterapis,email,' . $id . ',fisioterapis_id',
            'password' => 'confirmed',
            'phone'    => 'required',
            'address'  => 'required',
            'village'  => 'required',
            'district' => 'required',
            'city'     => 'required',
            'province' => 'required',
            'photo'    => 'nullable|mimes:png,jpg',
            'price'    => 'nullable',
            'about'    => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.fisioterapis.edit', $id)->with('error', $validator->errors()->first())->withInput();
        }

        if (!$request->old && !$request->file('images')) {
            return redirect()->route('admin.fisioterapis.edit', $id)->with('error', 'Galeri minimal satu')->withInput();
        }

        $fisio = Fisioterapis::findOrFail($id);
        $fisio->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'village'  => $request->village,
            'district' => $request->district,
            'city'     => $request->city,
            'province' => $request->province,
            'price'    => $request->price,
            'about'    => $request->about,
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Uuid::uuid4() . '.' . $file->extension();
            move_uploaded_file($file, public_path('uploads/fisioterapis') . '/' . $name);

            $photo = public_path('uploads/fisioterapis/' . $fisio->photo);
            if (file_exists($photo)) {
                unlink($photo);
            }

            $fisio->update([
                'photo' => $name
            ]);
        }

        if (!empty($request->password)) {
            $fisio->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $galeries = [];
        if ($request->old) {
            $galeries = Image::whereFisioterapisId($id)
                ->whereNotIn('image_id', $request->old)->get();
        }

        foreach ($galeries as $galery) {
            $image = public_path('uploads/image/' . $galery->image);
            if (file_exists($image)) {
                unlink($image);
            }
            $galery->delete();
        }

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = Uuid::uuid4() . '.' . $image->extension();
                move_uploaded_file($image, public_path('uploads/image') . '/' . $name);
                $fisio->images()->create([
                    'image' => $name
                ]);
            }
        }

        return redirect()->route('admin.fisioterapis.index')->with('success', 'Fisioterapis berhasil diedit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fisio = Fisioterapis::findOrFail($id);

        $photo = public_path('uploads/fisioterapis/' . $fisio->photo);
        if (file_exists($photo)) {
            unlink($photo);
        }

        foreach ($fisio->images as $galery) {
            $image = public_path('uploads/image/' . $galery->image);
            if (file_exists($image)) {
                unlink($image);
            }
        }

        $fisio->images()->delete();

        $fisio->delete();
        return redirect()->route('admin.fisioterapis.index')->with('success', 'Fisioterapis berhasil dihapus')->withInput();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
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
            'title' => 'required',
            'video' => 'required|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.video.create')->with('error', $validator->errors()->first())->withInput();
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $name = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();
            move_uploaded_file($file, public_path('uploads/video') . '/' . $name);
        }

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $name,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video' => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.video.create')->with('error', $validator->errors()->first())->withInput();
        }

        $video = Video::findOrFail($id);

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $name = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();
            move_uploaded_file($file, public_path('uploads/video') . '/' . $name);

            $videop = public_path('uploads/video/' . $video->video);
            if (file_exists($videop)) {
                unlink($videop);
            }

            $video->update(['video' => $name]);
        }

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diubah')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        $videop = public_path('uploads/video/' . $video->video);
        if (file_exists($videop)) {
            unlink($videop);
        }

        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus')->withInput();
    }
}

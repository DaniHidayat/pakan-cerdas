<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.article.create', compact('tags'));
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
            'title'   => 'required',
            'image'   => 'required|mimes:png,jpg',
            'content' => 'required',
            'tag.*'   => 'nullable|exists:tags,tag_id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.article.create')->with('error', $validator->errors()->first())->withInput();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();
            move_uploaded_file($file, public_path('uploads/article') . '/' . $name);
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $name,
        ]);
        $article->tags()->sync((array)$request->input('tag'));

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil ditambahkan')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::whereSlug($slug)->first();
        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Article::whereSlug($slug)->first();
        $tags = Tag::orderBy('name')->get();
        return view('admin.article.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'image'   => 'mimes:png,jpg',
            'content' => 'required',
            'tag.*'   => 'nullable|exists:tags,tag_id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.article.edit', $slug)->with('error', $validator->errors()->first())->withInput();
        }

        $article = Article::whereSlug($slug)->first();
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $article->tags()->sync((array)$request->input('tag'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();
            move_uploaded_file($file, public_path('uploads/article') . '/' . $name);

            $image = public_path('uploads/article/' . $article->image);
            if (file_exists($image)) {
                unlink($image);
            }

            $article->update(['image' => $name]);
        }

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil diedit')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $article = Article::whereSlug($slug)->first();

        $image = public_path('uploads/article/' . $article->image);
        if (file_exists($image)) {
            unlink($image);
        }

        $article->delete();
        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil dihapus')->withInput();
    }
}

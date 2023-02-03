<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::select('article_id', 'title', 'slug', 'image', 'content', 'created_at');
        if ($request->tag) {
            $articles->whereHas('tags', function ($q) use ($request) {
                $q->whereName($request->tag);
            });
        }
        if ($request->filter) {
            $filter = $request->filter;
            $date_range = $this->getFilter($filter);
            if (!$date_range) {
                return response()->json([
                    'message' => 'Filter tipe salah'
                ], 422);
            }
            $articles->whereBetween('created_at', $date_range);
        }

        $articles = $articles->orderBy('created_at', 'desc')->get();
        return response()->json([
            'data' => $articles,
        ]);
    }

    public function hot(Request $request)
    {
        $articles = Article::select('article_id', 'title', 'slug', 'image', 'content', 'created_at');
        if ($request->tag) {
            $articles->whereHas('tags', function ($q) use ($request) {
                $q->whereName($request->tag);
            });
        }
        if ($request->filter) {
            $filter = $request->filter;
            $date_range = $this->getFilter($filter);
            if (!$date_range) {
                return response()->json([
                    'message' => 'Filter tipe salah'
                ], 422);
            }
            $articles->whereBetween('created_at', $date_range);
        }
        $articles = $articles->withCount('comments')
            ->orderBy('comments_count', 'desc')->take(3)
            ->get();

        return response()->json([
            'data' => $articles,
        ]);
    }

    public function show($slug)
    {
        $article = Article::query()
            ->with('tags')
            ->whereSlug($slug)->first();
        if ($article) {
            return response()->json([
                'data' => new ArticleResource($article)
            ]);
        } else {
            return response()->json([
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }
    }

    public function comment(Request $request, $slug)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $article = Article::whereSlug($slug)->first();

        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $user = $request->user();

        $article->comments()->create([
            'source_id' => $user->user_id ?? $user->fisioterapis_id,
            'comment'   => $request->comment
        ]);

        return response()->json([
            'message' => 'Commentar berhasil'
        ]);
    }

    public function getFilter($filter)
    {
        if ($filter == 'today') {
            $start = Carbon::now()->startOfDay();
            $end =  Carbon::now()->endOfDay();
        } else if ($filter == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end =  Carbon::now()->endOfWeek();
        } else if ($filter == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end =  Carbon::now()->endOfMonth();
        } else {
            return false;
        }

        return [$start, $end];
    }
}

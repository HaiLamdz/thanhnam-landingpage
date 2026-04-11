<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;

class NewsController extends Controller
{
    public function index()
    {
        $posts = NewsPost::published()->orderedByDate()->paginate(10);

        return view('public.news.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = NewsPost::published()->where('slug', $slug)->firstOrFail();

        $related = NewsPost::published()
            ->where('id', '!=', $post->id)
            ->orderedByDate()
            ->limit(3)
            ->get();

        return view('public.news.show', compact('post', 'related'));
    }
}

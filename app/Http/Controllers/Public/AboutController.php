<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $content = setting('about_page_content');

        return view('public.about', compact('content'));
    }
}

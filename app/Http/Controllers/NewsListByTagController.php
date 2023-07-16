<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NewsListByTagController extends Controller
{
    public function __invoke($tag): View
    {
        return view('news-list-by-tag', ['tag' => $tag]);
    }
}

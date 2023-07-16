<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NewsDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('news-detail', ['slug' => $slug]);
    }
}

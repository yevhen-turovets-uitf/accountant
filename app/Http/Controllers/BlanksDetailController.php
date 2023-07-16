<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class BlanksDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('blanks-detail', ['slug' => $slug, 'model' => \App\Models\Blank::class, 'modelRedaction' => \App\Models\BlankRedaction::class]);
    }
}

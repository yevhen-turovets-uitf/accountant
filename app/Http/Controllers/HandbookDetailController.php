<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HandbookDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('handbook-detail', ['slug' => $slug, 'model' => \App\Models\Handbook::class, 'modelRedaction' => \App\Models\HandbookRedaction::class]);
    }
}

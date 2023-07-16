<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NormativeBaseDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('normative-base-detail', ['slug' => $slug, 'model' => \App\Models\Norm::class, 'modelRedaction' => \App\Models\NormRedaction::class]);
    }
}

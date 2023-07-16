<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HandbookSectionController extends Controller
{
    public function __invoke($slug): View
    {
        return view('handbook-section', ['slug' => $slug, 'model' => \App\Models\HandbookCategory::class, 'handbookDetail']);
    }
}

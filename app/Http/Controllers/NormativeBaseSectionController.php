<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NormativeBaseSectionController extends Controller
{
    public function __invoke($slug): View
    {
        return view('normative-base-section', ['slug' => $slug, 'model' => \App\Models\NormCategory::class, 'normativeBaseDetail']);
    }
}

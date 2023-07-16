<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class TaxSystemDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('tax-system-detail', ['slug' => $slug, 'model' => \App\Models\TaxSystem::class, 'modelRedaction' => \App\Models\TaxSystemRedaction::class]);
    }
}

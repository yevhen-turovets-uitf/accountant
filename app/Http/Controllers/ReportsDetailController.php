<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ReportsDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('reports-detail', ['slug' => $slug, 'model' => \App\Models\Report::class, 'modelRedaction' => \App\Models\ReportRedaction::class]);
    }
}

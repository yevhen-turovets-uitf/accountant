<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ReportsController extends Controller
{
    public function __invoke(): View
    {
        return view('reports', ['model' => \App\Models\ReportCategory::class, 'reportsDetail']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ConsultationDetailController extends Controller
{
    public function __invoke($slug): View
    {
        return view('consultations-detail', ['slug' => $slug, 'model' => \App\Models\Consultation::class, 'modelRedaction' => \App\Models\ConsultationRedaction::class]);
    }
}

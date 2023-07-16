<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ConsultationController extends Controller
{
    public function __invoke(): View
    {
        return view('consultations', ['model' => \App\Models\ConsultationCategory::class, 'consultationsDetail']);
    }
}

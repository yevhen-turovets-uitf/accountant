<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class TaxSystemController extends Controller
{
    public function __invoke(): View
    {
        return view('tax-system', ['model' => \App\Models\TaxSystemCategory::class, 'taxSystemDetail']);
    }
}

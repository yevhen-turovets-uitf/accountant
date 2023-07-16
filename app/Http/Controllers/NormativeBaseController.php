<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NormativeBaseController extends Controller
{
    public function __invoke(): View
    {
        return view('normative-base', ['model' => \App\Models\NormCategory::class]);
    }
}

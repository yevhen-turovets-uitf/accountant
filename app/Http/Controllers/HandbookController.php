<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HandbookController extends Controller
{
    public function __invoke(): View
    {
        return view('handbook', ['model' => \App\Models\HandbookCategory::class]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class BlanksController extends Controller
{
    public function __invoke(): View
    {
        return view('blanks', ['model' => \App\Models\BlankCategory::class, 'blanksDetail']);
    }
}

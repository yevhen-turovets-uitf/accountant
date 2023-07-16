<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HelpController extends Controller
{
    public function __invoke($slug = null): View
    {
        return view('help', ['slug' => $slug]);
    }
}

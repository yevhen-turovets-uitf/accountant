<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ForgotPasswordController extends Controller
{
    public function __invoke(): View
    {
        return view('forgot-password');
    }
}

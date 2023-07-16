<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ResetPasswordController extends Controller
{
    public function __invoke($email, $token): View
    {
        return view('reset-password', ['email' => $email, 'token' => $token]);
    }
}

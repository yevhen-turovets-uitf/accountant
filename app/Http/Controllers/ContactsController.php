<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ContactsController extends Controller
{
    public function __invoke(): View
    {
        return view('contacts');
    }
}

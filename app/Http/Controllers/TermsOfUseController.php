<?php

namespace App\Http\Controllers;

use App\Models\TermsOfUse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class TermsOfUseController extends Controller
{
    public function __invoke(): View
    {
        $termsOfUse = TermsOfUse::first();
        return view('terms-of-use', ['description' => $termsOfUse ? $termsOfUse->getDescription() : '']);
    }
}

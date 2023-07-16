<?php

namespace App\Http\Controllers;

use App\Models\PublicAgreement;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class PublicAgreementController extends Controller
{
    public function __invoke(): View
    {
        $publicAgreement = PublicAgreement::first();
        return view('public-agreement', ['description' => $publicAgreement ? $publicAgreement->getDescription() : '']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ContractForServices;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ContractForServicesController extends Controller
{
    public function __invoke(): View
    {
        $contractForServices = ContractForServices::first();
        return view('contract-for-services', ['description' => $contractForServices ? $contractForServices->getDescription() : '']);
    }
}

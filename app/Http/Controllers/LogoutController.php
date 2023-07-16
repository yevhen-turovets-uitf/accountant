<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LogoutAction;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(LogoutAction $logoutAction): RedirectResponse
    {
        $logoutAction->execute();

        return redirect()
            ->route('index');
    }
}

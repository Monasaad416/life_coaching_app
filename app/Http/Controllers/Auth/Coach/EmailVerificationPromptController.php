<?php

namespace App\Http\Controllers\Auth\Coach;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('coach')->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::COACH)
                    : view('auth.coach.verify-email');
    }
}

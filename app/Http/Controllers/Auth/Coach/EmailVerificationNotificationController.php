<?php

namespace App\Http\Controllers\Auth\Coach;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('coach')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::COACH);
        }

        $request->user('coach')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

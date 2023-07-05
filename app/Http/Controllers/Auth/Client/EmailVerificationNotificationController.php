<?php

namespace App\Http\Controllers\Auth\Client;

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
        if ($request->user('client')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CLIENT);
        }

        $request->user('client')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

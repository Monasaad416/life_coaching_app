<?php

namespace App\Http\Controllers\Auth\Coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CoachLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.coach.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(CoachLoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        Alert::success(trans('admin.logged'));

        $request->session()->regenerate();


        return redirect()->intended(RouteServiceProvider::COACH);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('coach')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::warning(trans('admin.warning'), trans('admin.loggedout'));
        return redirect('/selection');
    }
}

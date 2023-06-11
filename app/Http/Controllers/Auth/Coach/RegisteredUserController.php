<?php

namespace App\Http\Controllers\Auth\Coach;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.coach.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Coach::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $coach = Coach::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_name' => ["coach"],
        ]);

        $coach->assignRole('coach');

        event(new Registered($coach));


        

        Auth::guard('coach')->login($coach);
        Alert::success(trans('admin.congratulation'), trans('admin.registered'));

        return redirect(RouteServiceProvider::COACH);
    }
}

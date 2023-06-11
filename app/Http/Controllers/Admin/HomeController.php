<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminIndex() {
        return view('admin.dashboard.index');
    }

    public function clientIndex() {
        return view('client.dashboard.index');
    }


       public function coachIndex() {
        return view('coach.dashboard.index');
    }

       public function selection() {
        return view('auth.selection');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        return view('users_panel.users_dashboard');
    }
}

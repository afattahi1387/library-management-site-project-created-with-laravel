<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('dashboard.dashboard', ['categories' => $categories]);
    }
}

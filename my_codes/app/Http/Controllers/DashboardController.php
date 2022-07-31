<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        $categories = Category::orderBy('id', 'DESC')->get();
        if(isset($_GET['edit-category']) && !empty($_GET['edit-category'])) {
            $category_for_edit = Category::find($_GET['edit-category']);
            return view('dashboard.dashboard', ['categories' => $categories, 'category_for_edit' => $category_for_edit]);
        }
        return view('dashboard.dashboard', ['categories' => $categories]);
    }

    public function add_category(AddCategoryRequest $request) {
        Category::create([
            'category_name' => $request['category_name']
        ]);

        return redirect()->route('dashboard');
    }

    public function update_category(EditCategoryRequest $request, Category $category) {
        $category->update([
            'category_name' => $request['category_name']
        ]);

        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddPublisherRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\EditPublisherRequest;
use App\Publisher;

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

    public function publishers_page() {
        $publishers = Publisher::orderBy('id', 'DESC')->get();
        if(isset($_GET['edit-publisher']) && !empty($_GET['edit-publisher'])) {
            $publisher_for_edit = Publisher::find($_GET['edit-publisher']);
            return view('dashboard.publishers', ['publishers' => $publishers, 'publisher_for_edit' => $publisher_for_edit]);
        }
        return view('dashboard.publishers', ['publishers' => $publishers]);
    }

    public function add_publisher(AddPublisherRequest $request) {
        Publisher::create([
            'publisher_name' => $request['publisher_name']
        ]);

        return redirect()->route('publishers.page');
    }

    public function update_publisher(EditPublisherRequest $request, Publisher $publisher) {
        $publisher->update([
            'publisher_name' => $request['publisher_name']
        ]);

        return redirect()->route('publishers.page');
    }
}

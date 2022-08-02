<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddImageRequest;
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

    public function books_page() {
        $books = Book::orderBy('id', 'DESC')->get();
        return view('dashboard.books_page', ['books' => $books]);
    }

    public function delete_book(Book $book) {
        $book->delete();
        return redirect()->route('books.page');
    }

    public function add_book_page() {
        $categories = Category::orderBy('id', 'DESC')->get();
        $publishers = Publisher::orderBy('id', 'DESC')->get();
        return view('dashboard.add_book', ['categories' => $categories, 'publishers' => $publishers]);
    }

    public function create_book(AddBookRequest $request) {
        $new_book = Book::create([
            'name' => $request['name'],
            'image' => '',
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'category_id' => $request['category_id'],
            'publisher_id' => $request['publisher_id']
        ]);

        return redirect()->route('book.add.image', ['book' => $new_book->id]);
    }

    public function add_image_page(Book $book) {
        return view('dashboard.upload_image_for_new_book', ['book' => $book]);
    }

    public function upload_image(AddImageRequest $request, Book $book) {
        $imagePath = $request->image->path();
        $imageName = $request->image->getClientOriginalName();
        $imageNewName = $book->id . '_' . $imageName;
        move_uploaded_file($imagePath, 'uploads/books_images/' . $imageName);
        rename('uploads/books_images/' . $imageName, 'uploads/books_images/' . $imageNewName);
        copy('uploads/books_images/' . $imageNewName, 'images/books_images/' . $imageNewName);
        unlink('uploads/books_images/' . $imageNewName);
        $book->update([
            'image' => $imageNewName
        ]);

        return redirect()->route('single.book', ['book' => $book->id]);
    }
}

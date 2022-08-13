<?php

namespace App\Http\Controllers;

use App\Book;
use App\Writer;
use App\Category;
use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\AddImageRequest;
use App\Http\Requests\EditBookRequest;
use App\Http\Requests\AddWriterRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddPublisherRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\EditPublisherRequest;

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

    public function add_book_page() {
        $categories = Category::orderBy('id', 'DESC')->get();
        $publishers = Publisher::orderBy('id', 'DESC')->get();
        return view('dashboard.add_book', ['categories' => $categories, 'publishers' => $publishers]);
    }

    public function create_book(AddBookRequest $request) {
        $new_book = Book::create([
            'name' => $request['name'],
            'quantity' => $request['quantity'],
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

    public function edit_book(Book $book) {
        $categories = Category::orderBy('id', 'DESC')->get();
        $publishers = Publisher::orderBy('id', 'DESC')->get();
        return view('dashboard.edit_book', ['book' => $book, 'categories' => $categories, 'publishers' => $publishers]);
    }

    public function update_book(EditBookRequest $request, Book $book) {
        $name = $request->name;
        $quantity = $request->quantity;
        $short_description = $request->short_description;
        $long_description = $request->long_description;
        $category_id = $request->category_id;
        $publisher_id = $request->publisher_id;
        if(!empty($request->image)) {
            $imagePath = $request->image->path();
            $imageFileName = $request->image->getClientOriginalName();
            $image = $book->id . '_' . $imageFileName;
            move_uploaded_file($imagePath, 'uploads/books_images/' . $imageFileName);
            rename('uploads/books_images/' . $imageFileName, 'uploads/books_images/' . $image);
            unlink('images/books_images/' . $book->image);
            copy('uploads/books_images/' . $image, 'images/books_images/' . $image);
            unlink('uploads/books_images/' . $image);
        } else {
            $image = $book->image;
        }

        $book->update([
            'name' => $name,
            'quantity' => $quantity,
            'image' => $image,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'category_id' => $category_id,
            'publisher_id' => $publisher_id
        ]);

        return redirect()->route('single.book', ['book' => $book->id]);
    }

    public function trash() {
        $books = Book::orderBy('deleted_at', 'DESC')->onlyTrashed()->get();
        return view('dashboard.trash', ['books' => $books]);
    }

    public function move_to_trash(Book $book) {
        copy('images/books_images/' . $book->image, 'images/trash_images/' . $book->image);
        unlink('images/books_images/' . $book->image);
        $book->delete();
        return redirect()->route('trash');
    }

    public function recovery($book) {
        $book = Book::onlyTrashed()->find($book);
        copy('images/trash_images/' . $book->image, 'images/books_images/' . $book->image);
        unlink('images/trash_images/' . $book->image);
        $book->restore();
        return redirect()->route('books.page');
    }

    public function delete_book($book) {
        $book_information = Book::find($book);
        if(empty($book_information)) {
            $book_information = Book::onlyTrashed()->find($book);
        }
        $image = $book_information->image;
        if(empty($book_information->deleted_at)) {
            $image_address = 'images/books_images/' . $image;
            $route = 'books.page';
        } else {
            $image_address = 'images/trash_images/' . $image;
            $route = 'trash';
        }

        unlink($image_address);
        $book_information->forceDelete();
        return redirect()->route($route);
    }

    public function delete_category(Category $category) {
        if($category->books->count() >= 1) {
            abort(404);
        }

        $category->delete();
        return redirect()->route('dashboard');
    }

    public function delete_publisher(Publisher $publisher) {
        if($publisher->books->count() >= 1) {
            abort(404);
        }

        $publisher->delete();
        return redirect()->route('publishers.page');
    }

    public function add_writer() {
        return view('dashboard.add_writer');
    }

    public function create_writer(AddWriterRequest $request) {
        $new_writer = Writer::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => ''
        ]);

        return redirect()->route('upload.writer.image', ['writer' => $new_writer->id]);
    }

    public function upload_writer_image(Writer $writer) {
        dd($writer);
    }
}

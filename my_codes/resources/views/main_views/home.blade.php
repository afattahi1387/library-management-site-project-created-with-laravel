@extends('includes.html_structure')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <!-- Blog post-->
                @foreach($books as $book)
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="{{ asset('/images/books_images/' . $book->image) }}" alt="تصویر به نمایش در نیامد." /></a>
                        <div class="card-body">
                            <div class="small text-muted">دسته بندی: {{ $book->category->category_name }}</div><br>
                            <div class="small text-muted">انتشارات: {{ $book->publisher->publisher_name }}</div><br>
                            <h2 class="card-title h4">{{ $book->name }}</h2>
                            <p class="card-text">{{ $book->description }}</p>
                            <a class="btn btn-primary" href="#!">مشاهده اطلاعات کتاب →</a>
                        </div>
                    </div>
                @endforeach
                {{ $books->links() }}
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">جستجو</div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو..." aria-label="جستجو..." aria-describedby="button-search" /><br>
                            <input type="submit" value="برو" class="btn btn-primary" id="button-search">
                        </form>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">دسته بندی ها</div>
                    <div class="card-body">
                        <div class="row">
                            <ul class="list-unstyled mb-0">
                                @foreach($categories as $category)
                                    <li><a href="#!" style="text-decoration: none;">{{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('includes.html_structure')
@section('content')
    <br>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <!-- Blog post-->
                @foreach($books as $book)
                    <div class="card mb-4">
                        <a href="{{ route('single.book', ['book' => $book->id]) }}"><img class="card-img-top" src="{{ asset('/images/books_images/' . $book->image) }}" alt="تصویر به نمایش در نیامد." /></a>
                        <div class="card-body">
                            <div class="small text-muted">دسته بندی: {{ $book->category->category_name }}</div><br>
                            <div class="small text-muted">انتشارات: {{ $book->publisher->publisher_name }}</div><br>
                            <div class="small text-muted">تعداد کتاب: {{ $book->quantity }}</div><br>
                            <div class="small text-muted">نویسنده کتاب: {{ $book->writer->name }}</div><br>
                            <h2 class="card-title h4">{{ $book->name }}</h2>
                            <p class="card-text">{!! $book->short_description !!}</p>
                            <a class="btn btn-primary" href="{{ route('single.book', ['book' => $book->id]) }}">مشاهده اطلاعات کتاب →</a>
                        </div>
                    </div>
                @endforeach
                {{ $books->links() }}
            </div>
            @include('includes.main_pages_sidebar')
        </div>
    </div>
@endsection

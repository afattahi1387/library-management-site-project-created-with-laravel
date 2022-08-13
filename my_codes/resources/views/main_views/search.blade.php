@extends('includes.html_structure')

@section('title')
جستجو برای: {{ $_GET['searched'] }}
@endsection

@section('content')
    <br>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <!-- Blog post-->
                @if($books->count() < 1)
                    <div class="alert-danger" style="height: 30px; padding: 3px; border: none; border-radius: 5px;">کتابی یافت نشد!</div>
                @else
                    @foreach($books as $book)
                        <div class="card mb-4">
                            <a href="{{ route('single.book', ['book' => $book->id]) }}"><img class="card-img-top" src="{{ asset('/images/books_images/' . $book->image) }}" alt="تصویر به نمایش در نیامد." /></a>
                            <div class="card-body">
                                <div class="small text-muted">دسته بندی: {{ $book->category->category_name }}</div><br>
                                <div class="small text-muted">انتشارات: {{ $book->publisher->publisher_name }}</div><br>
                                <h2 class="card-title h4">{{ $book->name }}</h2>
                                <p class="card-text">{!! $book->short_description !!}</p>
                                <a class="btn btn-primary" href="{{ route('single.book', ['book' => $book->id]) }}">مشاهده اطلاعات کتاب →</a>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{ $books->links() }}
            </div>
            @include('includes.main_pages_sidebar')
        </div>
    </div>
@endsection

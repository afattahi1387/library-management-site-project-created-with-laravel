@extends('includes.html_structure')

@section('title', $book->name)

@section('content')
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">{{ $book->name }}</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">دسته بندی: {{ $book->category->category_name }}</div>
                            <div class="text-muted fst-italic mb-2">انتشارات: {{ $book->publisher->publisher_name }}</div>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('images/books_images/' . $book->image) }}" alt="تصویری برای نمایش وجود ندارد." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            {!! $book->short_description !!}
                            <hr>
                            {!! $book->long_description !!}
                        </section>
                        @if(Auth::check())
                            @if(Auth::user()->type == 'admin')
                                <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="btn btn-warning">ویرایش</a>
                            @else
                                <a href="{{ route('book.trust', ['book' => $book->id]) }}" class="btn btn-primary">امانت گرفتن</a>
                            @endif
                        @else
                            <a href="#" class="btn btn-primary disabled" role="button">امانت گرفتن</a>
                            <span class="text-danger">ابتدا باید وارد شوید</span>
                        @endif
                    </article><br>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                <!-- Comment with nested comments-->
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                        <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                        <!-- Child comment 2-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When you put money directly to a problem, it makes a good headline.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                @include('includes.main_pages_sidebar')
            </div>
        </div>
@endsection

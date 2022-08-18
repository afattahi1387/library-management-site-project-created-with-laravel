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
                            <div class="text-muted fst-italic mb-2">تعداد کتاب: {{ $book->quantity }}</div>
                            <div class="text-muted fst-italic mb-2">نام نویسنده: {{ $book->writer->name }}</div>
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
                                <a href="{{ route('book.edit', ['book' => $book->id]) }}" style="color: white;" class="btn btn-warning">ویرایش</a>
                            @else
                                @if($book->trusted())
                                    @if($book->check_status() == 'extended' || $book->check_status() == 'trusted')
                                        <a href="#" class="btn btn-primary disabled" role="button">امانت گرفتن</a>
                                        <span class="text-danger">شما قبلا این کتاب را به امانت گرفته اید</span>
                                    @else
                                        <a href="{{ route('trust.extended', ['book' => $book->id, 'user' => auth()->user()->id]) }}" class="btn btn-warning" style="color: white;">تمدید</a>
                                    @endif
                                @else
                                    @if(($book->quantity - $book->trusted) == 0)
                                        <a href="#" class="btn btn-primary disabled" role="button">امانت گرفتن</a>
                                        <span class="text-danger">تمامی کتاب های موجود به امانت گرفته شده است</span>
                                    @else
                                        <a href="{{ route('book.trust', ['book' => $book->id]) }}" class="btn btn-primary">امانت گرفتن</a>
                                    @endif
                                @endif
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
                                <h4>افزودن نظر</h4><br>
                                <form class="mb-4" action="{{ route('comment.add', ['book' => $book->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    @if(Auth::check())
                                        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                                    @else
                                        <input type="text" name="user_name" placeholder="نام" class="form-control"><br>
                                    @endif
                                    <textarea class="form-control" name="comment" rows="4" id="comment" placeholder="نظر شما"></textarea><br>
                                    <input type="submit" value="افزودن" class="btn btn-success">
                                </form>
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
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


        <script>
          tinymce.init({
            selector: '#comment',
            'directionality': 'rtl',
            plugins: [
    
              'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
    
              'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
    
              'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
    
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
    
              'alignleft aligncenter alignright alignjustify | ' +
    
              'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
          });
        </script>
@endsection

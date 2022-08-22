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
                        <br><br>
                        <h4 id="add_vote">رای دادن</h4><br>
                        <a href="{{ route('add.vote', ['book_id' => $book->id, 'vote' => 'great']) }}" class="btn btn-success">عالی بود</a>
                        <a href="{{ route('add.vote', ['book_id' => $book->id, 'vote' => 'not_bad']) }}" class="btn btn-warning" style="color: white;">بد نبود</a>
                        <a href="{{ route('add.vote', ['book_id' => $book->id, 'vote' => 'bad']) }}" class="btn btn-danger">اصلا خوب نبود</a>
                        <br><br>
                        <h4>رای های ثبت شده</h4>
                        <h5>رای های «عالی بود»: {{ $book->votes('great') }}</h5>
                        <h5>رای های «بد نبود»: {{ $book->votes('not_bad') }}</h5>
                        <h5>رای های «اصلا خوب نبود»: {{ $book->votes('bad') }}</h5>
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
                                <h4 id="comments">نظرات داده شده</h4><br>
                                @foreach($book->comments as $comment)
                                    <div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle" style="width: 60px; height: 60px;" src="/images/users_images/@if(empty($comment->user_profile))undefined_user.png @else{{ $comment->user_profile }} @endif" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">{{ $comment->user_name }}</div>
                                            {!! $comment->comment !!}
                                        </div>
                                    </div><br>
                                @endforeach
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

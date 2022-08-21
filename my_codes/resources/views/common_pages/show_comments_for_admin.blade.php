@extends('includes.dashboard_html_structure')

@section('title', 'نظرات داده شده توسط شما')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">نظرات داده شده توسط شما</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-comments"></i>
                        نظرات داده شده توسط شما
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کتاب</th>
                                    <th>متن نظر</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $commentsCounter = 0; @endphp
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>@php echo ++$commentsCounter; @endphp</td>
                                        <td><a href="{{ route('single.book', ['book' => $comment->book_id]) }}" target="_blank" style="text-decoration: none;">{{ $comment->book->name }}</a></td>
                                        <td>{!! $comment->comment !!}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-warning" style="color: white; margin-right: 2px;">ویرایش</a>
                                                <form action="{{ route('delete.comment', ['comment' => $comment->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button class="btn btn-danger" onclick="if(confirm('آیا از حذف این نظر مطمئـن هستید؟')){return true;}else{return false;}">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

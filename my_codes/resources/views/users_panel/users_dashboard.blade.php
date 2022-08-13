@extends('includes.users_dashboard_html_structure')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">داشبورد</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-book"></i>
                        کتاب های امانت گرفته شده
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کتاب</th>
                                    <th>تصویر</th>
                                    <th>دسته بندی</th>
                                    <th>انتشارات</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $booksCounter = 0; @endphp
                                @foreach ($trusted_books as $book)
                                    <tr>
                                        <td>@php echo ++$booksCounter; @endphp</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>
                                            <img src="/images/books_images/{{ $book->book->image }}" style="width: 150px; height: 50px; border-radius: 5px;" alt="تصویری به نمایش در نیامد.">
                                        </td>
                                        <td>{{ $book->book->category->category_name }}</td>
                                        <td>{{ $book->book->publisher->publisher_name }}</td>
                                        <td>
                                            @if($book->status()[0] == 'good')
                                                در حال امانت
                                            @else
                                                در حال جریمه خوردن
                                                <br>
                                                <span style="color: red;">({{ $book->status()[1] }} تومان)</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('single.book', ['book' => $book->book_id]) }}" class="btn btn-primary" style="margin-right: 2px;" target="_blank">مشاهده کتاب</a>
                                                <form action="{{ route('trust.restore', ['trust' => $book->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button class="btn btn-danger" onclick="if(confirm('آیا از بازگرداندن این کتاب مطمئـن هستید؟')){return true;}else{return false;}">بازگرداندن</button>
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

@extends('includes.dashboard_html_structure')

@section('title', 'کتاب ها')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">کتاب ها</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        کتاب ها
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
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $booksCounter = 0; @endphp
                                @foreach ($books as $book)
                                    <tr>
                                        <td>@php echo ++$booksCounter; @endphp</td>
                                        <td>{{ $book->name }}<br><span style="color: red;">({{ $book->quantity }} تا)</span></td>
                                        <td>
                                            <img src="/images/books_images/{{ $book->image }}" style="width: 150px; height: 50px; border-radius: 5px;" alt="تصویری به نمایش در نیامد.">
                                        </td>
                                        <td>{{ $book->category->category_name }}</td>
                                        <td>{{ $book->publisher->publisher_name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('single.book', ['book' => $book->id]) }}" target="_blank" style="margin-right: 2px;" class="btn btn-primary">مشاهده</a>
                                                <a href="{{ route('book.edit', ['book' => $book->id]) }}" style="color: white; margin-right: 2px;" class="btn btn-warning">ویرایش</a>
                                                <form action="{{ route('move.to.trash', ['book' => $book->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button onclick="if(confirm('آیا از انتقال این کتاب به سطل زباله مطمئـن هستید؟')){return true;}else{return false;}" class="btn btn-danger" style="margin-right: 2px;">انتقال به سطل زباله</button>
                                                </form>
                                                <form action="{{ route('book.delete', ['book' => $book->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button onclick="if(confirm('آیا از حذف این کتاب مطمئـن هستید؟')){return true;}else{return false;}" class="btn btn-danger">حذف کامل</button>
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

@extends('includes.dashboard_html_structure')

@section('icon', 'trash.png')

@section('title', 'سطل زباله')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">سطل زباله</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-trash"></i>
                        سطل زباله
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کتاب</th>
                                    <th>تصویر</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $booksCounter = 0; @endphp
                                @foreach($books as $book)
                                    <td>@php echo ++$booksCounter; @endphp</td>
                                    <td>{{ $book->name }}</td>
                                    <td style="width: 200px;">
                                        <img src="{{ asset('images/trash_images/' . $book->image) }}" alt="تصویری برای نمایش وجود ندارد." style="width: 200px; height: 50px; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('trash.books.recovery', ['book' => $book->id]) }}" style="margin-right: 2px;" class="btn btn-success">بازیابی</a>
                                            <form action="{{ route('book.delete', ['book' => $book->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <button onclick="if(confirm('آیا از حذف کامل این کتاب مطمئـن هستید؟')){return true;}else{return false;}" class="btn btn-danger">حذف کامل</button>
                                            </form>
                                        </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

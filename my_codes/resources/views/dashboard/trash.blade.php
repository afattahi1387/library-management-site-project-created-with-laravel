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
                                        <a href="#" class="btn btn-success">بازیابی</a>
                                        <button class="btn btn-danger">حذف کامل</button>
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

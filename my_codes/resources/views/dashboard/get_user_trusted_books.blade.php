@extends('includes.dashboard_html_structure')

@section('title')
مشاهده اطلاعات درباره: {{ $user->name }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">مشاهده اطلاعات درباره: {{ $user->name }}</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        کتاب های امانت گرفته شده برای: {{ $user->name }}
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کتاب</th>
                                    <th>تصویر</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $trustsCounter = 0; @endphp
                                @foreach ($books as $book)
                                    <tr>
                                        <td>@php echo ++$trustsCounter; @endphp</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>
                                            <img src="/images/books_images/{{ $book->book->image }}" style="width: 150px; height: 50px; border-radius: 5px;" alt="تصویری به نمایش در نیامد.">
                                        </td>
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
                                            <form action="{{ route('trust.restore', ['trust' => $book->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <button class="btn btn-danger" onclick="if(confirm('آیا از لغو امانت این امانت مطمئـن هستید؟')){return true;}else{return false;}">لغو امانت</button>
                                            </form>
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

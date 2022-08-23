@extends('includes.html_structure')

@section('title')
نمایش مشخصات نویسنده: {{ $writer->name }}
@endsection

@section('content')
    <br>
    <div style="background-color: #eee;">
        <hr>
        <img src="@if(!empty($writer->image)) {{ asset('/images/writers_images/' . $writer->image) }} @else {{ asset('/images/writers_images/undefined_writer.png') }} @endif" alt="تصویری به نمایش در نیامد" style="width: 20%; height: 100px; margin-right: 10px; border: none; border-radius: 100px;">
        <span>{{ $writer->name }}</span>
        <hr>
    </div>
    <div style="margin-right: 10px;">{!! $writer->description !!}</div><br>
    @if($writer->books->count() < 1)
        <div class="alert alert-danger" role="alert">
            کتابی یافت نشد!
        </div>
    @else
            <table class="table table-bordered">
                <tr>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>نام کتاب</th>
                </tr>
                @php $booksCounter = 0; @endphp
                @foreach($writer->books as $book)
                    <tr>
                        <td>@php echo ++$booksCounter; @endphp</td>
                        <td>
                            <img src="/images/books_images/{{ $book->image }}" alt="تصویری به نمایش در نیامد." style="width: 300px; border-radius: 5px;">
                        </td>
                        <td>
                            {{ $book->name }}
                            <br>
                            <a href="{{ route('single.book', ['book' => $book->id]) }}" target="_blank" class="btn btn-primary">مشاهده</a>
                        </td>
                    </tr>
                @endforeach
            </table>
    @endif
@endsection

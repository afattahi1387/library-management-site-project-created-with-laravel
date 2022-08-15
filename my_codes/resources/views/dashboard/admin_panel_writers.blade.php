@extends('includes.dashboard_html_structure')

@section('title', 'نویسندگان')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">نویسندگان</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-user"></i>
                        نویسندگان
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام نویسنده</th>
                                    <th>تصویر</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $writersCounter = 0;
                                @endphp
                                @foreach ($writers as $writer)
                                    <td>@php echo ++$writersCounter; @endphp</td>
                                    <td>{{ $writer->name }}</td>
                                    <td>
                                        <img src="@if(empty($writer->image)) {{ asset('images/writers_images/undefined_writer.png') }} @else {{ asset('images/writers_images/' . $writer->image) }} @endif" style="width: 150px; height: 50px; border-radius: 5px;" alt="تصویری به نمایش در نیامد.">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('single.writer', ['writer' => $writer->id]) }}" target="_blank" class="btn btn-primary" style="margin-right: 2px;">مشاهده مشخصات نویسنده</a>
                                            <a href="{{ route('writer.edit', ['writer' => $writer->id]) }}" class="btn btn-warning" style="margin-right: 2px; color: white;">ویرایش</a>
                                            <form action="{{ route('writer.delete', ['writer' => $writer->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <button class="btn btn-danger" onclick="if(confirm('آیا از حذف این نویسنده مطمئـن هستید؟')){return true;}else{return false;}">حذف</button>
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

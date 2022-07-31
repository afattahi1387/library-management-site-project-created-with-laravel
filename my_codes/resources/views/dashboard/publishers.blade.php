@extends('includes.dashboard_html_structure')
@section('title', 'انتشارات')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">انتشارات</h1><br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-edit"></i>
                                ویرایش انتشارات
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-publisher']) && !empty($_GET['edit-publisher']))
                                    <form action="{{ route('publisher.update', ['publisher' => $_GET['edit-publisher']]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <input type="text" name="publisher_name" placeholder="نام انتشارات" value="{{ $publisher_for_edit->publisher_name }}" class="form-control @if($errors->has('publisher_name')) is-invalid @endif">
                                        @if($errors->has('publisher_name'))
                                            <span class="text-danger">{{ $errors->first('publisher_name') }}</span><br>
                                        @endif
                                        <br>
                                        <input type="submit" style="color: white;" value="ویرایش" class="btn btn-warning">
                                    </form>
                                @else
                                    <span class="text-danger">فرم ویرایش انتشارات غیر فعال است. برای فعال کردن روی دکمه ویرایش در جدول زیر کلیک کنید.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-plus"></i>
                                افزودن انتشارات
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-publisher']) && !empty($_GET['edit-publisher']))
                                    <span class="text-danger">فرم افزودن انتشارات غیر فعال است؛ چون این صفحه در وضعیت ویرایش قرار دارد.</span>
                                @else
                                    <form action="{{ route('publisher.add') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" name="publisher_name" placeholder="نام انتشارات" class="form-control @if($errors->has('publisher_name')) is-invalid @endif">
                                        @if($errors->has('publisher_name'))
                                            <span class="text-danger">{{ $errors->first('publisher_name') }}</span><br>
                                        @endif
                                        <br>
                                        <input type="submit" value="افزودن" class="btn btn-success">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        انتشارات
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام انتشارات</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $publishersCounter = 0; @endphp
                                @foreach ($publishers as $publisher)
                                    <tr>
                                        <td>@php echo ++$publishersCounter; @endphp</td>
                                        <td>{{ $publisher->publisher_name }}</td>
                                        <td>
                                            <a href="{{ route('publishers.page') }}?edit-publisher={{ $publisher->id }}" style="color: white;" class="btn btn-warning">ویرایش</a>
                                            {{-- <button class="btn btn-danger">حذف</button> --}}
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

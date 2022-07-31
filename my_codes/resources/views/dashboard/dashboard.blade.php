@extends('includes.dashboard_html_structure')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">داشبورد</h1><br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-edit"></i>
                                ویرایش دسته بندی
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-category']) && !empty($_GET['edit-category']))
                                    <form action="{{ route('category.update', ['category' => $_GET['edit-category']]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <input type="text" name="category_name" placeholder="نام دسته بندی" value="{{ $category_for_edit->category_name }}" class="form-control @if($errors->has('category_name')) is-invalid @endif">
                                        @if($errors->has('category_name'))
                                            <span class="text-danger">{{ $errors->first('category_name') }}</span><br>
                                        @endif
                                        <br>
                                        <input type="submit" style="color: white;" value="ویرایش" class="btn btn-warning">
                                    </form>
                                @else
                                    <span class="text-danger">فرم ویرایش دسته بندی غیر فعال است. برای فعال کردن روی دکمه ویرایش در جدول زیر کلیک کنید.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-plus"></i>
                                افزودن دسته بندی
                            </div>
                            <div class="card-body" style="direction: rtl;">
                                @if(isset($_GET['edit-category']) && !empty($_GET['edit-category']))
                                    <span class="text-danger">فرم افزودن دسته بندی غیر فعال است؛ چون این صفحه در وضعیت ویرایش قرار دارد.</span>
                                @else
                                    <form action="{{ route('category.add') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" name="category_name" placeholder="نام دسته بندی" class="form-control @if($errors->has('category_name')) is-invalid @endif">
                                        @if($errors->has('category_name'))
                                            <span class="text-danger">{{ $errors->first('category_name') }}</span><br>
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
                        دسته بندی ها
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام دسته بندی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $categoriesCounter = 0; @endphp
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>@php echo ++$categoriesCounter; @endphp</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <a href="{{ route('dashboard') }}?edit-category={{ $category->id }}" style="color: white;" class="btn btn-warning">ویرایش</a>
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

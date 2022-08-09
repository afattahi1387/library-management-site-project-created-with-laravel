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
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $booksCounter = 0; @endphp
                                @foreach ($trusted_books as $book)
                                    <tr>
                                        <td>@php echo ++$booksCounter; @endphp</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex">
                                                {{-- <a href="{{ route('dashboard') }}?edit-category={{ $category->id }}" style="color: white; margin-right: 2px;" class="btn btn-warning">ویرایش</a>
                                                @if($category->books->count() < 1)
                                                    <form action="{{ route('category.delete', ['category' => $category->id]) }}" method="POST" id="delete_category_form">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button onclick="if(confirm('آیا از حذف این دسته بندی مطمئـن هستید؟')){return true;}else{return false;}" class="btn btn-danger">حذف</button>
                                                    </form>
                                                @endif --}}
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

@extends('includes.dashboard_html_structure')

@section('title', 'کتاب های امانت گرفته شده')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">کتاب های امانت گرفته شده</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-search"></i>
                        جستجو کاربر
                    </div>
                    <div class="card-body">
                        <form action="{{ route('find.user.trusted.books') }}" method="GET" style="direction: rtl;">
                            <input type="text" name="searched_user" placeholder="جستجو کاربر" value="@if(isset($_GET['searched_user']) && !empty($_GET['searched_user'])){{ $_GET['searched_user'] }}@endif" class="form-control"><br>
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                @if(isset($_GET['searched_user']) && !empty($_GET['searched_user']))
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user"></i>
                            کاربران یافت شده
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>تصویر</th>
                                        <th>نام کاربر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $usersCounter = 0; @endphp
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>@php echo ++$usersCounter; @endphp</td>
                                            <td>
                                                <img src="/images/users_images/@if(empty($result->image))undefined_user.png @else{{ $result->image }} @endif" style="width: 150px; height: 50px; border-radius: 5px;" alt="تصویری به نمایش در نیامد.">
                                            </td>
                                            <td><a href="{{ route('get.user.trusted.books', ['user' => $result->id]) }}" style="text-decoration: none;">{{ $result->name }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection

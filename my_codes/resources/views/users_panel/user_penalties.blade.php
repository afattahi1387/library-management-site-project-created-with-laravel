@extends('includes.users_dashboard_html_structure')

@section('title', 'جریمه ها')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">جریمه ها</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-ban"></i>
                        جریمه ها
                    </div>
                    <div class="card-body">
                        @if($sum_of_penalties != 0)
                            <b>جمع جریمه ها: </b><span>{{ $sum_of_penalties }}</span><br><br>
                        @endif
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کتاب</th>
                                    <th>جریمه</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $penaltiesCounter = 0;
                                @endphp
                                @foreach ($penalties as $penalty)
                                    <tr>
                                        <td>@php echo ++$penaltiesCounter; @endphp</td>
                                        <td>{{ $penalty->book_name }}</td>
                                        <td>{{ $penalty->penalty }} تومان</td>
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

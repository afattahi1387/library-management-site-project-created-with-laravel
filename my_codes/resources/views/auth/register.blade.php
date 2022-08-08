@extends('includes.authentication_html_structure')
@section('icon', 'register.png')
@section('title', env('APP_NAME') . ' | ثبت نام')
@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4"><a href="{{ route('home') }}" style="text-decoration: none;">{{ env('APP_NAME') }}</a> | ثبت نام</h3></div>
                                <div class="card-body">
                                    <form action="/register" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-floating mb-3">
                                            <input class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}" id="name" type="text" placeholder="نام" />
                                            <label for="name">نام</label>
                                            @if($errors->has('name'))
                                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="ایمیل" />
                                            <label for="email">ایمیل</label>
                                            @if($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" value="{{ old('password') }}" id="password" type="password" placeholder="رمز عبور" />
                                            <label for="password">رمز عبور</label>
                                            @if($errors->has('password'))
                                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">{{-- <a class="btn btn-primary btn-block" href="login.html">Create Account</a> --}}
                                                <input type="submit" class="btn btn-primary btn-block" value="تایید">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@extends('includes.authentication_html_structure')
@section('icon', 'login.png')
@section('title', env('APP_NAME') . ' | ورود')
@section('content')
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><a style="text-decoration: none;" href="{{ route('home') }}">{{ env('APP_NAME') }}</a> | ورود</h3></div>
                                    <div class="card-body">
                                        <form action="/login" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-floating mb-3">
                                                <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" id="email" type="email" placeholder="ایمیل" />
                                                <label for="email">ایمیل</label>
                                                @if($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="password" type="password" placeholder="رمز عبور" />
                                                <label for="password">رمز عبور</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" name="remember" id="remember_me" type="checkbox" value="" />
                                                <label class="form-check-label" for="remember_me">مرا به خاطر بسپار</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                                                <input type="submit" value="ورود" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    {{-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
@endsection

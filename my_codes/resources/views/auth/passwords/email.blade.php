@extends('includes.authentication_html_structure')
@section('icon', 'reset_password.png')
@section('title', 'بازیابی رمز عبور')
@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">بازیابی رمز عبور</h3></div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted" style="direction: rtl;">لطفا ایمیل خود را وارد کنید و روی دکمه تایید کلیک کنید تا ایمیل بازیابی برای شما ارسال شود.</div>
                                    @if (session('status'))
                                        <div class="alert alert-success">ایمیل با موفقیت ارسال شد</div>
                                    @endif
                                    <form action="{{ route('password.email') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-floating mb-3">
                                            <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" id="email" type="email" placeholder="ایمیل" value="{{ old('email') }}" />
                                            <label for="email">ایمیل</label>
                                            @if($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input type="submit" value="تایید" class="btn btn-primary">
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

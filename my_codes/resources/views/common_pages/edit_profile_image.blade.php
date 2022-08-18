<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ویرایش تصویر پروفایل</title>
    <link rel="icon" href="/images/icons/edit.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('/css/styles2.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('redirect.to.dashboard') }}">داشبورد</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div class="container-fluid px-4">
            <h1 class="mt-4">ویرایش تصویر پروفایل</h1><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit"></i>
                    ویرایش تصویر پروفایل
                </div>
                <div class="card-body">
                    <form action="{{ route('update.profile.image') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="mb-3">
                            <div>تصویر قبلی:</div><br>
                            <img src="/images/users_images/@if(empty(auth()->user()->image))undefined_user.png @else{{ auth()->user()->image }} @endif" alt="تصویری به نمایش در نیامد." style="width: 100%; height: 300px; border: none; border-radius: 5px;"><br><br>
                            <label for="image" class="form-label">لطفا تصویر جدید پروفایل خود را از کادر زیر آپلود کنید.</label>
                            <input class="form-control" name="profile_image" type="file" id="image">
                            @if($errors->has('profile_image'))
                                <span class="text-danger">{{ $errors->first('profile_image') }}</span><br>
                            @endif
                            <br>
                            <input type="submit" value="ذخیره" class="btn btn-warning" style="color: white;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>
</html>

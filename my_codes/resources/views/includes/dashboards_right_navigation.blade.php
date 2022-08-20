    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">@if(empty(auth()->user()->image))<i class="fas fa-user fa-fw"></i>@else<img src="/images/users_images/{{ auth()->user()->image }}" style="width: 40px; height: 40px; margin-right: 2px;" />@endif</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li class="dropdown-header">{{ auth()->user()->name }}</li>
                <li><a class="dropdown-item" href="{{ route('edit.profile.image.form') }}">تغییر تصویر پروفایل</a></li>
                <li><a class="dropdown-item" href="#!">حذف تصویر پروفایل</a></li>
                <li><a class="dropdown-item" href="#!">ویرایش اطلاعات کاربری</a></li>
            </ul>
        </li>
    </ul>

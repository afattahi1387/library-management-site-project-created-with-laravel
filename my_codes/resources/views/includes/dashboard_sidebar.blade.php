<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">صفحات</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    داشبورد
                </a>
                <a class="nav-link" href="{{ route('publishers.page') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-newspaper" aria-hidden="true"></i></div>
                    انتشارات ها
		        </a>
                <a class="nav-link" href="{{ route('book.add.page') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-plus"></i></div>
                    افزودن کتاب
                </a>
                <a class="nav-link" href="{{ route('books.page') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                    کتاب ها
                </a>
                <a class="nav-link" href="{{ route('writer.add') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-plus"></i></div>
                    افزودن نویسنده
                </a>
                <a class="nav-link" href="{{ route('admin.panel.writers') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                    نویسندگان
                </a>
                <a class="nav-link" href="{{ route('admin.panel.messages') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-message"></i></div>
                    پیام های ارسال شده
                </a>
                <a class="nav-link" href="{{ route('find.user.trusted.books') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-handshake"></i></div>
                    کتاب های امانت گرفته شده
                </a>
                <a class="nav-link" href="{{ route('trash') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-trash"></i></div>
                    سطل زباله
                </a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                    <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
                    خروج
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout_form">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </nav>
</div>

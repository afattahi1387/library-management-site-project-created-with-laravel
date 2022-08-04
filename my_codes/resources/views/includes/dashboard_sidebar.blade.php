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
                    انتشارات
		        </a>
                <a class="nav-link" href="{{ route('book.add.page') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-plus"></i></div>
                    افزودن کتاب
                </a>
                <a class="nav-link" href="{{ route('books.page') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                    کتاب ها
                </a>
                <a class="nav-link" href="{{ route('trash') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-trash"></i></div>
                    سطل زباله
                </a>
            </div>
        </div>
    </nav>
</div>

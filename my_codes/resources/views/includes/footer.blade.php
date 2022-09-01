<footer class="py-5 bg-dark">
    <form action="{{ route('add.to.mail.news') }}" method="POST" style="margin-right: 10px;">
        {{ csrf_field() }}
        <h5 style="color: white;">عضویت در خبرنامه</h5>
        <div class="d-flex">
            <input type="text" name="user_email" placeholder="ایمیل شما" class="form-control" style="width: 50%;" required>
            <input type="submit" value="عضویت" class="btn btn-primary" style="margin-right: 3px;">
        </div>
    </form><br><br>
    <div class="container"><p class="m-0 text-center text-white">تمامی حقوق این سایت متعلق به <a class="footer-a" href="{{ route('home') }}">{{ env('APP_NAME') }}</a> است.</p></div>
</footer>

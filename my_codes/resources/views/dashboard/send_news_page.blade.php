@extends('includes.dashboard_html_structure')
@section('icon', 'send.png')
@section('title', 'ارسال خبر در خبرنامه')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ارسال خبر در خبرنامه</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-paper-plane"></i>
                        ارسال خبر در خبرنامه
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('send.news.in.mail.news') }}" method="POST">
                            {{ csrf_field() }}
                            <textarea name="news" id="news" placeholder="خبر" class="form-control" rows="15"></textarea>
                            @if($errors->has('news'))
                                <span class="text-danger">{{ $errors->first('news') }}</span><br>
                            @endif
                            <br>
                            <input type="submit" value="ارسال" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
      tinymce.init({
        selector: '#news',
        'directionality': 'rtl',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>
@endsection

@extends('includes.users_dashboard_html_structure')
@section('icon', 'edit.png')
@section('title', 'ویرایش نظر')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ویرایش نظر</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                        ویرایش نظر
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('update.comment', ['comment' => $comment->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <textarea name="comment" id="comment" placeholder="نظر" class="form-control" rows="15">{{ $comment->comment }}</textarea>
                            @if($errors->has('comment'))
                                <span class="text-danger">{{ $errors->first('comment') }}</span><br>
                            @endif
                            <br>
                            <input type="submit" value="ویرایش" style="color: white;" class="btn btn-warning">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
      tinymce.init({
        selector: '#comment',
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

      tinymce.init({
        selector: '#long_description',
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

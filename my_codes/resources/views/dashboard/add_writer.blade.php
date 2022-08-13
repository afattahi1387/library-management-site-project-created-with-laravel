@extends('includes.dashboard_html_structure')
@section('icon', 'add.jpg')
@section('title', 'افزودن نویسنده')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">افزودن نویسنده</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        افزودن نویسنده
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('writer.create') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="name" placeholder="نام نویسنده" class="form-control @if($errors->has('name')) is-invalid @endif" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span><br>
                            @endif
                            <br>
                            <textarea name="writer_description" id="writer_description" rows="15" class="form-control" placeholder="رزومه">{{ old('writer_description') }}</textarea>
                            @if($errors->has('writer_description'))
                                <span class="text-danger">{{ $errors->first('writer_description') }}</span><br>
                            @endif
                            <br>
                            <div class="form-check mb-3">
                                <input class="form-input" name="image_required" id="image_required" type="checkbox" />
                                <label class="form-check-label" for="image_required">نمایش فرم آپلود تصویر برای این نویسنده</label>
                            </div>
                            <input type="submit" value="افزودن" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
      tinymce.init({
        selector: '#writer_description',
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

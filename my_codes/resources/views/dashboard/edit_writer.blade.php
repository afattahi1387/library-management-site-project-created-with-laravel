@extends('includes.dashboard_html_structure')
@section('icon', 'edit.png')
@section('title')
ویرایش نویسنده: {{ $writer->name }}
@endsection
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ویرایش نویسنده</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                        ویرایش نویسنده: {{ $writer->name }}
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('writer.update', ['writer' => $writer->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="text" name="name" placeholder="نام نویسنده" value="@if(empty(old('name'))) {{ $writer->name }} @else {{ old('name') }} @endif" class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span><br>
                            @endif
                            <br>
                            <textarea name="writer_description" id="writer_description" placeholder="رزومه" class="form-control" rows="15">@if(empty(old('writer_description'))) {{ $writer->description }} @else {{ old('writer_description') }} @endif</textarea>
                            @if($errors->has('writer_description'))
                                <span class="text-danger">{{ $errors->first('writer_description') }}</span><br>
                            @endif
                            <br>
                            <label for="old_image">تصویر این نویسنده:</label><br><br>
                            <img src="@if(empty($writer->image)) {{ asset('images/writers_images/undefined_writer.png') }} @else {{ asset('images/writers_images/' . $writer->image) }} @endif" id="old_image" style="width: 100%; border-radius: 5px;" alt="تصویری برای نمایش وجود ندارد.">
                            <br><br>
                            <div class="mb-3">
                                <label for="image" class="form-label">در صورت تمایل می توانید تصویر جدید این نویسنده را آپلود کنید:</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
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

@extends('includes.dashboard_html_structure')
@section('icon', 'edit.png')
@section('title')
ویرایش کتاب: {{ $book->name }}
@endsection
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">ویرایش کتاب</h1><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        ویرایش کتاب: {{ $book->name }}
                    </div>
                    <div class="card-body" style="direction: rtl;">
                        <form action="{{ route('book.update', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="text" name="name" placeholder="نام کتاب" value="@if(empty(old('name'))) {{ $book->name }} @else {{ old('name') }} @endif" class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span><br>
                            @endif
                            <br>
                            <input type="number" name="quantity" placeholder="تعداد کتاب" min="{{ $book->trusted }}" value="@if(empty(old('quantity'))){{ $book->quantity }}@else{{ old('quantity') }}@endif" class="form-control @if($errors->has('quantity')) is-invalid @endif">
                            @if($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span><br>
                            @endif
                            <br>
                            <textarea name="short_description" id="short_description" placeholder="توضیحات کوتاه" class="form-control" rows="15">@if(empty(old('short_description'))) {{ $book->short_description }} @else {{ old('short_description') }} @endif</textarea>
                            @if($errors->has('short_description'))
                                <span class="text-danger">{{ $errors->first('short_description') }}</span><br>
                            @endif
                            <br>
                            <textarea name="long_description" id="long_description" placeholder="توضیحات بلند" class="form-control" rows="15">@if(empty(old('long_description'))) {{ $book->long_description }} @else {{ old('long_description') }} @endif</textarea>
                            @if($errors->has('long_description'))
                                <span class="text-danger">{{ $errors->first('long_description') }}</span><br>
                            @endif
                            <br>
                            <label for="category_id">دسته بندی:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    @if($book->category_id == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label for="publisher_id">انتشارات:</label>
                            <select name="publisher_id" id="publisher_id" class="form-control">
                                @foreach($publishers as $publisher)
                                    @if($book->publisher_id == $publisher->id)
                                        <option value="{{ $publisher->id }}" selected>{{ $publisher->publisher_name }}</option>
                                    @else
                                        <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label for="writer_id">نویسنده:</label>
                            <select name="writer_id" id="writer_id" class="form-control">
                                @foreach($writers as $writer)
                                    @if($book->writer_id == $writer->id)
                                        <option value="{{ $writer->id }}" selected>{{ $writer->name }}</option>
                                    @else
                                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label for="old_image">تصویر این کتاب:</label><br><br>
                            <img src="{{ asset('images/books_images/' . $book->image) }}" id="old_image" style="width: 100%; border-radius: 5px;" alt="تصویری برای نمایش وجود ندارد.">
                            <br><br>
                            <div class="mb-3">
                                <label for="image" class="form-label">در صورت تمایل می توانید تصویر جدید این کتاب را از کادر زیر آپلود کنید:</label>
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
        selector: '#short_description',
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

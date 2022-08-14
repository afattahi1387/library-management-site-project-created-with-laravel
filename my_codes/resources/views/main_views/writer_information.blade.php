@extends('includes.html_structure')

@section('title')
نمایش مشخصات نویسنده: {{ $writer->name }}
@endsection

@section('content')
    <br>
    <div style="background-color: #eee;">
        <hr>
        <img src="@if(!empty($writer->image)) {{ asset('/images/writers_images/' . $writer->image) }} @else {{ asset('/images/writers_images/undefined_writer.png') }} @endif" alt="تصویری به نمایش در نیامد" style="width: 20%; height: 100px; margin-right: 10px; border: none; border-radius: 100px;">
        <span>{{ $writer->name }}</span>
        <hr>
    </div>
    <div style="margin-right: 10px;">{!! $writer->description !!}</div>
@endsection

@component('mail::message')
# خبر جدید از خبرنامه

خبرنامه {{ config('app.name') }} خبری برای شما ارسال کرده است.

## متن خبر

{!! $news !!}

@endcomponent

@component('mail::message')
# درخواست امانت کتاب با موفقیت ثبت شد.

{{ $trust->user->name }}، شما درخواست امانت کتاب "{{ $trust->book->name }}" را کرده اید.

درخواست شما با موفقیت ثبت شد و کتاب در حال امانت برای شما است.

برای مشاهده کتاب های در حال امانت خود روی رکمه زیر کلیک کنید:

@component('mail::button', ['url' => env('APP_URL') . '/redirect-to-dashboard'])
مشاهده کتاب های در حال امانت
@endcomponent

@endcomponent

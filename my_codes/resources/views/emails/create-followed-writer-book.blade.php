@component('mail::message')
# کتابی جدید ساخته شد

![تصویری به نمایش در نیامد.]({{ $book_image_address }})

{{ $user_name }}، شما دنبال کننده {{ $book->writer->name }} هستید؛

کتابی با نام "{{ $book->name }}" ایجاد شده است که نوشته شده توسط این نویسنده است.

برای مشاهده اطلاعات این کتاب و امانت گرفتن آن، روی دکمه زیر کلیک کنید:

@component('mail::button', ['url' => env('APP_URL') . '/single-book/' . $book->id])
مشاهده اطلاعات کتاب
@endcomponent

@endcomponent

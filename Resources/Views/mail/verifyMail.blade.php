@component('mail::message')
    # کد فعال سازی حساب شما در وب آموز

    این ایمیل جهت تائید ثبت نام شما می باشد.
    **اگر شما ثبت نامی انجام نداده اید**  این ایمیل را نادیده بگیرید

    @component('mail::panel')
        کدشما:{{$code}}
    @endcomponent

    با تشکر,<br>
    {{ config('app.name') }}
@endcomponent


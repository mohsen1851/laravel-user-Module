@component('mail::message')
    # کد بازیابی رمز عبور حساب شما در وب آموز

    این ایمیل جهت بازیابی رمز عبور شما می باشد.
    **اگر شما درخواست بازیابی انجام نداده اید**  این ایمیل را نادیده بگیرید

    @component('mail::panel')
        کدشما:{{$code}}
    @endcomponent

    با تشکر,<br>
    {{ config('app.name') }}
@endcomponent

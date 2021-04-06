@extends('User::Front.Auth.master')
@section('content')
    <form action="{{route('password.checkVerifyCode')}}" class="form" method="post">
        @csrf
        <input name="email" type="hidden" value="{{request('email')}}">
        <a class="account-logo" href="{{route('index')}}">
            <img src="{{asset('img/weblogo.png')}}" alt="">
        </a>
        <div class="card-header">
            <p class="activation-code-title">کد فرستاده شده به ایمیل شما
                را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
            </p>
        </div>
        <div class="form-content form-content1">
            <input class="activation-code-input" name="verifyCode" placeholder="فعال سازی">
            <br>
            @error('verifyCode')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <br>
            <button class="btn i-t">تایید</button>
            <a href="#" onclick="event.preventDefault();document.getElementById('resend').submit()">
                ارسال مجدد کد بازیابی
            </a>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>

    <form method="post" id="resend" action="{{route('password.checkVerifyCode')}}">@csrf</form>
@endsection

@section('js')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection


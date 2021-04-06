@extends('User::Front.Auth.master')
@section('content')
    <form action="{{route('login')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">


            <input type="text" name="email" class="txt-l txt @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autocomplete="email" autofocus
                   placeholder="ایمیل یا شماره موبایل"
            >

            <input type="password" name="password" required autocomplete="current-password"
                   class="txt-l txt @error('password') is-invalid @enderror" placeholder="رمز عبور">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection

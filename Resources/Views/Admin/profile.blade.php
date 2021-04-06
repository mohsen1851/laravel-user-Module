@extends('Dashboard::master')
@section('content')
    <p class="box__title">ویرایش پروفایل </p>
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <form action="{{route('users.updateProfile')}}" class="padding-30" method="post">
                @csrf
                @method('patch')
                <x-input-Box type="text" name="name" required inputValue="{{$user->name}}" class="text"
                             placeholder="نام کاربر"/>
                <x-input-box type="text" name="email" required inputValue="{{$user->email}}" class="text text-left "
                             placeholder="ایمیل کاربر"/>
                <x-input-box type="text" name="username" inputValue="{{$user->username}}"
                             class="text text-left "
                             placeholder="نام کاربری"/>
                <x-input-box type="password" name="password" inputValue=""
                             class="text "
                             placeholder="رمزعبور جدید"/>
                <x-input-box type="text" name="mobile" inputValue="{{$user->mobile}}" class="text text-left "
                             placeholder="موبایل"/>
                <x-input-box type="text" name="linkedin" inputValue="{{$user->linkedin}}"
                             class="text text-left "
                             placeholder="لینکدین"/>
                <x-input-box type="text" name="facebook" inputValue="{{$user->facebook}}"
                             class="text text-left "
                             placeholder="فیسبوک"/>
                <x-input-box type="text" name="telegram" inputValue="{{$user->telegram}}"
                             class="text text-left "
                             placeholder="تلگرام"/>
                <x-input-box type="text" name="instagram" inputValue="{{$user->instagram}}"
                             class="text text-left "
                             placeholder="اینستاگرام"/>
                <x-input-box type="text" name="youtube" inputValue="{{$user->youtube}}" class="text text-left "
                             placeholder="یوتوب"/>
                <x-validation-error field="image"/>
                <textarea placeholder="بیو" name="bio" class="text h">{!! $user->bio !!}</textarea>
                <button class="btn btn-webamooz_net" type="submit">ویرایش کاربر</button>
            </form>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربر">کاربر</a></li>
    <li><a href="#" title="ویرایش">ویرایش پروفایل</a></li>
@endsection

@section('css')
    <link rel="stylesheet" href="/panel/css/jquery_toast_plugin.css"/>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js"></script>
    <script src="/panel/js/jquery_toast_plugin.js"></script>
    @include('Common::layouts.feedbacks')
@endsection

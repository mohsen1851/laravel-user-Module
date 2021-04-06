@extends('Dashboard::master')
@section('content')
    <p class="box__title">ویرایش کاربر </p>
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <form action="{{route('users.update',$user->id)}}" class="padding-30" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input-Box type="text" name="name" required inputValue="{{$user->name}}" class="text"
                             placeholder="نام کاربر"/>
                <x-input-box type="text" name="email" required inputValue="{{$user->email}}" class="text text-left "
                             placeholder="ایمیل کاربر"/>
                <x-input-box type="text" name="username"  inputValue="{{$user->username}}"
                             class="text text-left "
                             placeholder="نام کاربری"/>
                <x-input-box type="password" name="password"  inputValue=""
                             class="text "
                             placeholder="رمزعبور جدید"/>
                <x-input-box type="text" name="mobile"  inputValue="{{$user->mobile}}" class="text text-left "
                             placeholder="موبایل"/>
                <x-input-box type="text" name="linkedin"  inputValue="{{$user->linkedin}}"
                             class="text text-left "
                             placeholder="لینکدین"/>
                <x-input-box type="text" name="facebook"  inputValue="{{$user->facebook}}"
                             class="text text-left "
                             placeholder="فیسبوک"/>
                <x-input-box type="text" name="telegram"  inputValue="{{$user->telegram}}"
                             class="text text-left "
                             placeholder="تلگرام"/>
                <x-input-box type="text" name="instagram"  inputValue="{{$user->instagram}}"
                             class="text text-left "
                             placeholder="اینستاگرام"/>
                <x-input-box type="text" name="youtube"  inputValue="{{$user->youtube}}" class="text text-left "
                             placeholder="یوتوب"/>

                <x-select name="status">
                    <option value="">وضعیت حساب</option>
                    @foreach(\Mohsen\User\Models\User::$statuses as $status)
                        <option value="{{$status}}" @if($status==$user->status)) selected @endif>@lang($status)</option>
                    @endforeach
                </x-select>
                <x-select name="role">
                    <option value="">کاربر عادی</option>
                    @foreach($roles as $role)
                        <option value="{{$role->name}}" @if($user->hasRole($role)) selected @endif>@lang($role->name)</option>
                    @endforeach
                </x-select>
                <div class="file-upload" style="margin-top: 15px">
                    <div class="i-file-upload">
                        <span>آپلود عکس کاربر</span>
                        <input type="file" class="file-upload" id="files" name="image"/>
                    </div>
                    <span class="filesize"></span>
                    @if($user->image_id)
                        <div style="margin-top: 15px">
                            عکس فعلی
                            <img src="{{$user->image->thumb}}" alt="" width="180">
                        </div>
                    @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    @endif
                </div>
                <x-validation-error field="image"/>
                <textarea placeholder="بیو" name="bio" class="text h">{!! $user->bio !!}</textarea>
                <button class="btn btn-webamooz_net" type="submit">ویرایش کاربر</button>
            </form>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربر">کاربر</a></li>
    <li><a href="#" title="ویرایش">ویرایش کاربر</a></li>
@endsection

@section('css')
    <link rel="stylesheet" href="/panel/css/jquery_toast_plugin.css"/>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js"></script>
    <script src="/panel/js/jquery_toast_plugin.js"></script>
    @include('Common::layouts.feedbacks')
@endsection

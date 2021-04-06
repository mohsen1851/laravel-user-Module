@extends('Dashboard::master')
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کاربران</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>id</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>وضعیت تائید</th>
                        <th>مشخصات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr role="row" class="">
                            <td><a href="">{{$user->id}}</a></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->roles as $userRole)
                                    <ul>
                                        <li class="showRemoveLink">@Lang($userRole->name)
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td id="verified">{{$user->hasVerifiedEmail()?'تائید شده':'تائید نشده'}}</td>
                            <td>
                                <a href=""
                                   onclick="
                                       event.preventDefault();
                                       deleteItem(event,'{{route('users.destroy',$user->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{route('users.edit',$user->id)}}"
                                   class="item-edit mlg-15" title="ویرایش"></a>
                                <a href=""
                                   onclick="
                                       event.preventDefault();
                                       updateConfirmationStatus(
                                       event,'{{route('users.manualVerify',$user->id)}}',
                                       'آیا از تائید این کاربر اطمینان دارید؟','تائید شد'
                                       )"
                                   class="item-confirm mlg-15" title="تائید"></a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="/panel/css/jquery_toast_plugin.css"/>
@endsection
@section('js')
    <script src="/panel/js/jquery_toast_plugin.js"></script>
    @include('Common::layouts.feedbacks')
    <script>
        function deleteItem(event, route) {
            if (confirm('آیا از حذف این آیتم اطمینان دارید؟')) {
                $.post(route, {
                    _method: "delete",
                    _token: "{{csrf_token()}}"
                })
                    .done(function (response) {
                            event.target.closest('tr').remove();
                            $.toast({
                                heading: 'عملیات موفق',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        }
                    )
                    .fail(function (response) {
                            $.toast({
                                heading: 'عملیات ناموفق',
                                text: 'خطایی رخ داد!',
                                showHideTransition: 'slide',
                                icon: 'warning'
                            })
                        }
                    )
            }
        }


        function updateConfirmationStatus(event, route, message, status) {
            if (confirm(message)) {
                $.post(route, {
                    _method: "PATCH",
                    _token: "{{csrf_token()}}"
                })
                    .done(function (response) {
                            $(event.target).closest('tr').find('td#verified').text(status);
                            $.toast({
                                heading: 'عملیات موفق',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        }
                    )
                    .fail(function (response) {
                            $.toast({
                                heading: 'عملیات ناموفق',
                                text: 'خطایی رخ داد!',
                                showHideTransition: 'slide',
                                icon: 'warning'
                            })
                        }
                    )
            }
        }
    </script>
@endsection

@section('breadcrumb')
    <li><a href="#" title="کاربران">کاربران</a></li>
@endsection


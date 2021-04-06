<?php

namespace Mohsen\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Mohsen\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use Mohsen\User\Http\Requests\resetPasswordVerityRequest;
use Mohsen\User\Http\Requests\VerifyCodeRequest;
use Mohsen\User\Models\User;
use Mohsen\User\Repositories\UserRepo;
use Mohsen\User\Services\VerifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function showLinkRequestForm(Request $request, $token = null)
//    {
//        ->with(
//            ['token' => $token, 'email' => $request->email]
//        );
//    }

    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.Auth.recoverPassword');
    }

    public function sendVerifyCodeEmail(resetPasswordVerityRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);

        if ($user && !VerifyCodeService::has($user->id)) {
            $user->resetPasswordRequestNotification();
            return view('User::Front.passwords.enter-verify-code-form');
        }

        return abort(404);
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if ($user == null || !VerifyCodeService::Check($user->id, $request->verifyCode)) {
            return back()->withErrors(['verifyCode' => 'کد وارد شده صحیح نیست']);
        }

        \Auth::loginUsingId($user->id);
        return redirect()->route('password.showResetForm');
    }
}

<?php
Route::group([
    'namespace' => 'Mohsen\User\Http\Controllers',
    'middleware' => 'web'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('editUser/profile', 'UserController@profile')->name('users.profile');
        Route::patch('editUser/updateProfile', 'UserController@updateProfile')->name('users.updateProfile');
        Route::group(['middleware' => ['verified']], function () {
            Route::patch('users/{user}/manualVerify', 'UserController@manualVerify')->name('users.manualVerify');
            Route::post('users/updatePhoto', 'UserController@updatePhoto')->name('users.updatePhoto');
            Route::resource('users', 'UserController');
        });
    });
    Route::post('users/{user}/add/role', 'UserController@addRole')->name('users.addRole');
    Route::post('/email/verify', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');

    // login
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

    // logout
    Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

    // reset password
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showVerifyCodeRequestForm')
        ->name('password.request');
    Route::get('/password/reset/send', 'Auth\ForgotPasswordController@sendVerifyCodeEmail')
        ->name('password.sendVerifyCodeEmail');
    Route::post('/password/reset/check-verify-code', 'Auth\ForgotPasswordController@checkVerifyCode')
        ->middleware('throttle:5,1')
        ->name('password.checkVerifyCode');

    Route::get('/password/showResetForm', 'Auth\ResetPasswordController@showResetForm')
        ->middleware('auth')
        ->name('password.showResetForm');

    Route::post('/password/change', 'Auth\ResetPasswordController@reset')->name('password.update');

    // register
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
});








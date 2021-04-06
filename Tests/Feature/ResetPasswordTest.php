<?php

namespace Mohsen\User\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_reset_password_page()
    {
        $this->get(route('password.request'))->assertOk();
    }

    public function test_user_can_get_verify_email_by_correct_email()
    {
        $this->post(route('register'),
            [
                'name' => 'mohsen',
                'email' => 'm2@gmail.com',
                'mobile' => '9902460858',
                'password' => '123!aA123',
                'password_confirmation' => '123!aA123'
            ]
        );
        Artisan::call('cache:clear');
        $this->call('get',route('password.sendVerifyCodeEmail',['email' => 'm2@gmail.com']))->assertOk();
    }

    public function test_user_can_not_get_verify_email_by_wrong_email()
    {
        $this->post(route('register'),
            [
                'name' => 'mohsen',
                'email' => 'm2@gmail.com',
                'mobile' => '9902460858',
                'password' => '123!aA123',
                'password_confirmation' => '123!aA123'
            ]
        );
        Artisan::call('cache:clear');
        $this->call('get',route('password.sendVerifyCodeEmail',['email' => 'gmail.com']))->assertStatus(302);
    }

}

<?php

namespace Mohsen\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mohsen\RolePermissions\Models\Permission;
use Mohsen\User\Models\User;
use Mohsen\User\Services\VerifyCodeService;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_register_form()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();
        $response = $this->registerUser();
        $response->assertRedirect(route('home'));
        $this->assertCount(1, User::all());
    }


    public function test_user_have_to_verified(): void
    {
        $this->withoutExceptionHandling();
        $this->registerUser();
        $response = $this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));

    }

    public function test_user_can_verify_account()
    {
        $this->withoutExceptionHandling();
        $user = User::create(
            [
                'name' => 'mohsen',
                'email' => 'm2@gmail.com',
                'mobile' => '9902460858',
                'password' => '123!aA123'
            ]
        );
        \Auth::loginUsingId($user->id);
        $this->assertAuthenticated();
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(auth()->id(), $code, now()->addDay());

        $this->post(route('verification.verify'), [
            'verifyCode' => $code
        ]);

        $this->assertEquals(true,auth()->user()->hasVerifiedEmail());
    }

    public function test_verified_user_can_see_home_page()
    {
        $this->withoutExceptionHandling();
        foreach (Permission::$permission as $permission) {
            \Spatie\Permission\Models\Permission::findOrCreate($permission);
        }
        $this->registerUser();
        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('home'));
        $response->assertOk();

    }


    public function registerUser()
    {
        return $this->post(route('register'),
            [
                'name' => 'mohsen',
                'email' => 'm2@gmail.com',
                'mobile' => '9902460858',
                'password' => '123!aA123',
                'password_confirmation' => '123!aA123'
            ]
        );
    }
}

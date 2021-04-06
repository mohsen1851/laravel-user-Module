<?php

namespace Mohsen\User\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mohsen\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_by_email()
    {
        $this->withoutExceptionHandling();
        $user =$this->createUser();
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123!aA123'
        ]);

        $this->assertAuthenticated();
    }

    public function test_user_can_login_by_mobile()
    {
        $this->withoutExceptionHandling();
        $user =$this->createUser();
        $this->post(route('login'), [
            'email' => $user->mobile,
            'password' => '123!aA123'
        ]);

        $this->assertAuthenticated();
    }

    public function createUser()
    {
        return  User::create([
            'name' => 'mohsen',
            'email' => 'm2@gmail.com',
            'mobile' => '9902460858',
            'password' => bcrypt('123!aA123'),
        ]);
    }
}

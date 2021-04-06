<?php
namespace Mohsen\User\Database\factories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohsen\User\Models\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class UserFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{
protected $model=User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'mobile' => '936'.random_int(1000000,9999999),
            'email_verified_at' => Carbon::now()->subDays(3),
            'password' => bcrypt(123),
            'status' => 'active',
            'username'=>$this->faker->userName,
            'balance'=>random_int(5000,500000)
        ];
    }
}


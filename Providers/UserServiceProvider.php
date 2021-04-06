<?php


namespace Mohsen\User\Providers;


use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Mohsen\User\Database\seeds\UserSeeder;
use Mohsen\User\Http\Middleware\getUserIp;
use Mohsen\User\Models\User;
use Mohsen\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadFactoriesFrom(__DIR__ . '/../Database/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'User');
        Gate::policy(User::class, UserPolicy::class);
        $this->app['router']->pushMiddlewareToGroup('web', getUserIp::class);

        Factory::guessFactoryNamesUsing(function ($modelName) {
            return 'Mohsen\User\Database\factories\\' . class_basename($modelName) . 'Factory';
        });
    }

    public function boot()
    {
        config()->set('auth.providers.users.model', User::class);

        $this->app->booted(function () {
            config()->set('sidebar.items.users',
                [
                    'icon' => 'i-users',
                    'title' => 'کاربر ها',
                    'url' => route('users.index'),
                    'permission' => \Mohsen\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS
                ]
            );
            config()->set('sidebar.items.userInformation',
                [
                    'icon' => 'i-user__inforamtion',
                    'title' => 'اطلاعات کاربری',
                    'url' => route('users.profile')
                ]
            );
        });
    }
}

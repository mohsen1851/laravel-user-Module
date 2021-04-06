<?php


namespace Mohsen\User\Services;


use Mohsen\User\Models\User;

class UserServices
{
    public static function changePassword($user, $password)
    {
        $user->update(['password' => $password]);
    }
}

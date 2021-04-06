<?php


namespace Mohsen\User\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Mohsen\RolePermissions\Models\Permission;
use Mohsen\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;


    public function addRole(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }
    public function removeRole(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }

    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }
    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }
    public function manualVerify(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }
    public function destroy(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }
}

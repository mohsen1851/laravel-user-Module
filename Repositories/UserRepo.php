<?php

namespace Mohsen\User\Repositories;

use Mohsen\RolePermissions\Models\Permission;
use Mohsen\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findById($id)
    {
        return User::query()->where('id', $id)->first();
    }

    public function paginate()
    {
        return User::paginate();
    }

    public function update($user_id, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'username' => $values->username,
            'mobile' => $values->mobile,
            'headline' => $values->headline,
            'telegram' => $values->telegram,
            'youtube' => $values->youtube,
            'instagram' => $values->instagram,
            'linkedin' => $values->linkedin,
            'facebook' => $values->facebook,
            'bio' => $values->bio,
            'status' => $values->status,
            'image_id' => $values->image_id
        ];
        if (!is_null($values->password)) {
            $update['password'] = bcrypt($values->password);
        }
        $user = $this->findById($user_id);
        $user->syncRoles([]);
        if ($values['role']) {
            $user->assignRole($values['role']);
        }
        return $user->update($update);
    }

    public function updateProfile($request)
    {
        $user = auth()->user();
        $values = [
            'name' => $request->name,
            'bio' => $request->bio,
            'username' => $request->username
        ];
        if ($request->email != $user->email) {
            $values += ['email' => $request->email, 'email_verified_at' => null];
            $user->sendEmailVerificationNotification();
        }
        if ($request->password) {
            $values += ['password' => bcrypt($request->password)];
        }
        return $user->update($values);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getUsers($pagination = null, $search = null) {
        $users = User::where('team_id', session('team')->id);

        if (!empty($search)) {
            $users->where(function($q) use($search) {
                $q->where('email', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        $users->orderBy('id', 'asc');

        if (is_int($pagination)) {
            return $users->paginate($pagination);
        }
        return $users->get();
    }

    public function getUserById($id) {
        return $this->getUsers()->find($id);
    }

    public function createUser($email, $first_name, $last_name, $password) {
        $user = new User();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->team_id = session('team')->id;
        $user->save();

        session('team')->refresh();
        return $user;
    }

    public function updateUser(User $user, $email, $first_name, $last_name) {
        $user->email = $email;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->save();
        session('team')->refresh();
    }

    public function updateUserPassword(User $user, $password) {
        $user->password = Hash::make($password);
        $user->save();
    }

    public function updateUserRoles(User $user, $roles) {
        $user->roles()->detach();
        foreach($roles as $role) {
            $user->roles()->attach($role);
        }
        session('team')->refresh();
    }

    public function deleteUser(User $user) {
        $user->delete();
        session('team')->refresh();
    }
}
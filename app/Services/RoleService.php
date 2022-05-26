<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function getRoles() {
        return Role::all();
    }

    public function getRoleById($id) {
        return Role::find($id);
    }

    public function getRoleByName($name) {
        return Role::where('name', $name)->first();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasMany(User::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function hasProject(Project $project) {
        foreach ($this->projects as $p) {
            if ($p->id == $project->id) {
                return true;
            }
        }
        return false;
    }
}

<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function createTeam($name) {
        $team = new Team();
        $team->name = $name;
        $team->save();
        return $team;
    }
}
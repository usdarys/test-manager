<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Team;

class ProjectService 
{
    public function validateProject(Request $request) {
        $project = Project::find(explode('/', $request->path())[0]);
        if (session('team')->hasProject($project)) {
            session()->put('project', $project);
            return $project;
        }
        abort(404);
    }

    public function getProjectsByTeam(Team $team, $pagination = null) {
        $projects = Project::where('team_id', $team->id);
        if (is_int($pagination)) {
            return $projects->paginate($pagination);
        }
        return $projects->get();
    }

    public function createProject($name, Team $team) {
        $project = new Project();
        $project->name = $name;
        $project->team()->associate($team);
        $project->save();
        $team->refresh();
        return $team;
    }
}
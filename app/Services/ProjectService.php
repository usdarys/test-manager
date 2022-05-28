<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;

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
}
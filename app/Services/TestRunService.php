<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TestRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestRunService
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $index  Index of resource ID in request path
     */
    public function validateTestRun(Request $request, $index = 2) {
        $project = $this->projectService->validateProject($request);
        $testRun = $this->getTestRunsByProject($project)->find(explode('/', $request->path())[$index]);
        if ($testRun) {
            return $testRun;
        }
        abort(404);
    }

    public function getTestRunsByProject(Project $project) {
        return $project->testRuns;
    }

    public function createTestRun($name, $description, Project $project, $testCases) {
        $testRun = new TestRun();
        $testRun->name = $name;
        $testRun->description = $description;
        $project->testRuns()->save($testRun);

        foreach ($testCases as $testCase) {
            $testRun->testCases()->attach($testCase);
        }

        $testRun->refresh();
        $project->refresh();
        return $testRun;
    }
}
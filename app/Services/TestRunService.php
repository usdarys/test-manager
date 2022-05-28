<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TestRun;

class TestRunService
{
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
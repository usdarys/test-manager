<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TestCase;

class TestCaseService
{
    public function getTestCasesByProject(Project $project) {
        return $project->testCases;
    }

    public function getTestCaseById($id) {
        return TestCase::find($id);
    }

    public function createTestCase($name, $preconditions, $steps, $expectedResult, Project $project) {
        $testCase = new TestCase();
        $testCase->name = $name;
        $testCase->preconditions = $preconditions;
        $testCase->steps = $steps;
        $testCase->expected_result = $expectedResult;
        
        $project->testCases()->save($testCase);
        $project->refresh();
        return $testCase;
    }
}
<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TestCase;

class TestCaseService
{
    public function getTestCasesByProject(Project $project, $pagination = null, $search = null) {
        $testCases = TestCase::where('project_id', $project->id);

        if (!empty($search)) {
            $testCases->where('name', 'ilike', '%' . $search . '%');
        }

        $testCases->orderBy('id', 'asc');

        if (is_int($pagination)) {
            return $testCases->paginate($pagination);
        }
        return $testCases->get();
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
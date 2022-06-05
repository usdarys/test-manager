<?php

namespace App\Services;

use App\Models\TestResult;
use App\Models\TestRun;
use Illuminate\Http\Request;

class TestResultService
{
    protected $testRunService;

    public function __construct(TestRunService $testRunService)
    {
        $this->testRunService = $testRunService;
    }

    public function validateTestCase(Request $request) {
        $testRun = $this->testRunService->validateTestRun($request);
        $testCase = $testRun->testCases->find(explode('/', $request->path())[3]);
        if ($testCase) {
            return $testCase;
        }
        abort(404);
    }

    public function updateTestResult($testCase, $status, $comment, $user) {
        $testRun = $this->testRunService->getTestRunById($testCase->result->test_run_id);
        $testRun->testCases()->updateExistingPivot($testCase, [
            'status' => $status,
            'comment' => $comment,
            'updated_by' => $user->id
        ]);
    }

    public function getTestCasesByTestRun(TestRun $testRun, $pagination = null, $search = null) {
        $testCases = $testRun->testCases();

        if (!empty($search)) {
            $testCases->where('name', 'ilike', '%' . $search . '%');
        }

        $testCases->orderBy('id', 'asc');

        if (is_int($pagination)) {
            return $testCases->paginate($pagination);
        }        
        return $testCases->get();
    }
}
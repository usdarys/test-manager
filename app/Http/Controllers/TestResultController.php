<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Services\ProjectService;
use App\Services\TestResultService;
use App\Services\TestRunService;
use App\Services\UserService;
use App\Types\TestResultStatusType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TestResultController extends Controller
{
    protected $testRunService, $projectService, $testResultService, $userService;

    public function __construct(TestRunService $testRunService, ProjectService $projectService, TestResultService $testResultService, UserService $userService)
    {
        $this->testRunService = $testRunService;
        $this->projectService = $projectService;
        $this->testResultService = $testResultService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testRun = $this->testRunService->validateTestRun($request);

        return view('test-result-list', [
            'testRun' => $testRun,
            'statusTypes' => TestResultStatusType::getList(),
            'stats' => $this->testRunService->getTestRunStats($testRun),
            'users' => $this->userService->getUsers()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $testCase = $this->testResultService->validateTestCase($request);

        Log::info($testCase);

        return view('test-result', [
            'testCase' => $testCase,
            'statusTypes' => TestResultStatusType::getList()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $testCase = $this->testResultService->validateTestCase($request);

        $this->testResultService->updateTestResult(
            $testCase,
            $request->status,
            $request->comment,
            $request->user()
        );

        return redirect()->route('test-result.index', ['project' => session('project'), 'testRun' => $testCase->result->test_run_id]);
    }
}

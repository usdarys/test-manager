<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRunRequest;
use App\Models\Project;
use App\Models\TestRun;
use App\Services\ProjectService;
use App\Services\TestCaseService;
use App\Services\TestRunService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class TestRunController extends Controller
{
    protected $projectService, $testRunService, $testCaseService;

    public function __construct(ProjectService $projectService, TestRunService $testRunService, TestCaseService $testCaseService)
    {
        $this->projectService = $projectService;
        $this->testRunService = $testRunService;
        $this->testCaseService = $testCaseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin', 'Tester']));

        $project = $this->projectService->validateProject($request);

        return view('test-run-list', [
            'testRuns' => $this->testRunService->getTestRunsByProjectWithPagination($project, 5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin', 'Tester']));

        $project = $this->projectService->validateProject($request);
        
        return view('test-run', [
            'testRun' => new TestRun(),
            'testCases' => $this->testCaseService->getTestCasesByProject($project),
            'form_title' => 'Nowy przebieg testowy',
            'form_action' => route('test-run.store', ['project' => $project]),
            'form_button' => 'Dodaj przebieg'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRunRequest $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin', 'Tester']));

        $project = $this->projectService->validateProject($request);

        $testCases = $this->getTestCases($request, $project);

        $this->testRunService->createTestRun(
            $request->name,
            $request->description,
            $project,
            $testCases
        );

        session()->flash('status', 'Dodano nowy przebieg');
        return redirect()->route('test-run.index', ['project' => $project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getTestCases(Request $request, Project $project) {
        if ($request->include_type == 'all') {
            $testCases = $this->testCaseService->getTestCasesByProject($project);
        } else {
            $testCases = [];
            foreach($request->all() as $key => $val) {
                if (preg_match('/^tc_/', $key)) {
                    $testCases[] = $this->testCaseService->getTestCaseById($val);
                }
            }
        }
        return $testCases;
    }
}

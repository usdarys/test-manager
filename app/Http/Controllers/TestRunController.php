<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRunRequest;
use App\Models\Project;
use App\Models\TestCase;
use App\Models\TestRun;
use App\Services\ProjectService;
use App\Services\TestRunService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestRunController extends Controller
{
    protected $projectService, $testRunService;

    public function __construct(ProjectService $projectService, TestRunService $testRunService)
    {
        $this->projectService = $projectService;
        $this->testRunService = $testRunService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = $this->projectService->validateProject($request);

        return view('test-run-list', [
            'testRuns' => $project->testRuns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('test-run', [
        //     'testCases' => $project->
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRunRequest $request)
    {
        $testRun = new TestRun();
        $testRun->name = $request->name;
        $testRun->description = $request->description;
        $testRun->save();

        // dodac nowe results

        session()->flash('status', 'Dodano nowy przebieg');
        return redirect()->route('test-run.index');
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
}

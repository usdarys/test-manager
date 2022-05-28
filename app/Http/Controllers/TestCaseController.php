<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestCaseRequest;
use App\Models\TestCase;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\TestCaseService;

class TestCaseController extends Controller
{
    protected $projectService, $testCaseService;

    public function __construct(ProjectService $projectService, TestCaseService $testCaseService)
    {
        $this->projectService = $projectService;
        $this->testCaseService = $testCaseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $project = $this->projectService->validateProject($request);

        return view('test-case-list', [
            'testCases' => $this->testCaseService->getTestCasesByProject($project)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = $this->projectService->validateProject($request);

        return view('test-case', [
            'testCase' => new TestCase(),
            'form_title' => 'Nowy przypadek testowy',
            'form_action' => route('test-case.store', ['project' => $project]),
            'form_button' => 'Dodaj przypadek testowy'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestCaseRequest $request)
    {
        $project = $this->projectService->validateProject($request);

        $this->testCaseService->createTestCase(
            $request->name,
            $request->preconditions,
            $request->steps,
            $request->expected_result,
            $project
        );

        session()->flash('status', 'Dodano przypadek testowy');
        return redirect()->route('test-case.index', ['project' => $project]);
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

<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TestRun;
use App\Types\TestResultStatusType;
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

    public function getTestRunsByProject(Project $project, $pagination = null, $search = null) {
        $testRuns = TestRun::where('project_id', $project->id);

        if (!empty($search)) {
            $testRuns->where('name', 'ilike', '%' . $search . '%');
        }
        
        $testRuns->orderBy('created_at', 'desc');

        if (is_int($pagination)) {
            return $testRuns->paginate($pagination);
        }

        return $testRuns->get();
    }

    public function getTestRunById($id) {
        return TestRun::find($id);
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

    public function getTestRunStats(TestRun $testRun) {
        $all = $testRun->testCases->count();
        $untested = $testRun->testCases->where('result.status', TestResultStatusType::UNTESTED)->count();
        $tested = $all - $untested; 
        $passed = $testRun->testCases->where('result.status', TestResultStatusType::PASSED)->count();
        $failed = $testRun->testCases->where('result.status', TestResultStatusType::FAILED)->count();

        return [
            'all' => $all,
            'untested' => $untested,
            'tested' => $tested,
            'passed' => $passed,
            'failed' => $failed,
            'untestedPercent' => ($all > 0) ? round(($untested*100)/$all, 2) : 0,
            'testedPercent' => ($all > 0) ? round(($tested*100)/$all, 2) : 0,
            'passedPercent' => ($all > 0) ? round(($passed*100)/$all, 2) : 0,
            'failedPercent' => ($all > 0) ? round(($failed*100)/$all, 2) : 0
        ];
    } 

}
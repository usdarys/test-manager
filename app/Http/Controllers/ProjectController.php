<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin', 'Tester']));

        if ($request->ajax()) {
            $view = 'project.list';
        } else {
            $view = 'project.page';
        }

        return view($view, [
            'projects' => $this->projectService->getProjectsByTeam(session('team'), 5, $request->search)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        return view('project.form', [
            'project' => new Project(),
            'form_title' => 'Nowy projekt',
            'form_action' => route('project.store'),
            'form_button' => 'Utwórz'            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        $this->projectService->createProject(
            $request->name,
            session('team')
        );

        session()->flash('status', 'Dodano projekt');
        return redirect()->route('project.index');
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

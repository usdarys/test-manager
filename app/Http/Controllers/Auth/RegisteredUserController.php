<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Services\RoleService;
use App\Services\TeamService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class RegisteredUserController extends Controller
{
    protected $userService, $teamService, $roleService;

    public function __construct(UserService $userService, TeamService $teamService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->teamService = $teamService;
        $this->roleService = $roleService;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        $team = $this->teamService->createTeam($request->team_name);
        session()->put('team', $team);

        $user = $this->userService->createUser(
            $request->email,
            $request->first_name,
            $request->last_name,
            $request->password
        );

        $roles[] = $this->roleService->getRoleByName('Admin');
        $this->userService->updateUserRoles($user, $roles);

        //event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

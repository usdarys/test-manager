<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService, $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        return view('user.page', [
            'userList' => $this->userService->getUsers(5)
        ]);
    }

    public function getList()
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        return view('user.list', [
            'userList' => $this->userService->getUsers(5)
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

        return view('user.form', [
            'user' => new User(),
            'roles' => $this->roleService->getRoles(),
            'form_title' => 'Nowy użytkownik',
            'form_action' => route('user.store'),
            'form_button' => 'Dodaj użytkownika'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        $user = $this->userService->createUser(
            $request->email,
            $request->first_name,
            $request->last_name,
            $request->password
        );

        $roles = $this->getRoles($request);
        $this->userService->updateUserRoles($user, $roles);

        session()->flash('status', 'Dodano uzytkownika');
        return redirect()->route('user.index');
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
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('user.form', [
            'user' => $user,
            'roles' => $this->roleService->getRoles(),
            'form_title' => 'Edycja użytkownika',
            'form_action' => route('user.update', ['user' => $id]),
            'form_button' => 'Zapisz zmiany'
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
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)]
        ]);        

        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }

        $this->userService->updateUser(
            $user,
            $request->email,
            $request->first_name,
            $request->last_name
        );

        if ($request->filled('password') || $request->filled('password_confirmation')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $this->userService->updateUserPassword($user, $request->password);
        }

        $roles = $this->getRoles($request);
        $this->userService->updateUserRoles($user, $roles);

        session()->flash('status', 'Zapisano uzytkownika');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::allowIf(fn ($user) => $user->hasRoles(['Admin']));

        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        $this->userService->deleteUser($user);

        session()->flash('status', 'Usunięto uzytkownika');
        return redirect()->route('user.index');
    }

    private function getRoles(Request $request) {
        $roles = [];
        foreach($request->all() as $key => $val) {
            if (preg_match('/^role_/', $key)) {
                $roles[] = $this->roleService->getRoleById($val);
            }
        }
        return $roles;
    }
}

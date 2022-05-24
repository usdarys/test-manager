<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user-list', [
            'userList' => session('team')->users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user', [
            'user' => new User(),
            'roles' => Role::all(),
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
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->team_id = session('team')->id;
        $user->save();

        foreach($request->all() as $key => $val) {
            if (preg_match('/^role_/', $key)) {
                $user->roles()->attach($val);
            }
        }

        session()->flash('status', 'Dodano uzytkownika');
        session('team')->refresh();
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
        $user = User::find($id);
        return view('user', [
            'user' => User::find($id),
            'roles' => Role::all(),
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
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)]
        ]);        

        $user = User::find($id);
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->filled('password') || $request->filled('password_confirmation')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->roles()->detach();
        foreach($request->all() as $key => $val) {
            if (preg_match('/^role_/', $key)) {
                $user->roles()->attach($val);
            }
        }

        session()->flash('status', 'Zapisano uzytkownika');
        session('team')->refresh();
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
        $user = User::find($id);
        $user->delete();
        
        session('team')->refresh();
        return redirect()->route('user.index');
    }
}

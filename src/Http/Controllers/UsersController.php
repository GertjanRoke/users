<?php

namespace IntoTheSource\Users\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\updateUserRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        return '<h1>inportant!</h1> Add: "packages/Source/Users/src/Models" to "classmap" and "packages/Source/Users/src/Http/Requests" in the composer.json file in your main folder!<br>Without this the model connection would not work.<br>Do not forget to execute the composer command: "composer dump-autoload" and remove this line from the controller.';

        $users = User::all();
        $deletedUsers = User::onlyTrashed()->get();
        return view('UMViews::users.index', compact('users', 'deletedUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id');
        return view('UMViews::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User;
        $request['password'] = bcrypt($request->get('password'));
        $user = $user->create($request->only($user->getFillable()));
        $user->roles()->sync(collect($request->get('role'))->all());

        return redirect()->route('user.manager.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id');
        return view('UMViews::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->get('password') && ( bcrypt($request->get('old_password')) == $user->password)) {
            $request['password'] = bcrypt($request->get('password'));
        } elseif(!$request->get('password')) {
            $request['password'] = $user->password;
        } else {
            return redirect()->back()->withInput()->withErrors(['password' => 'The given password is not correct.']);
        }
        $user->update($request->only($user->getFillable()));
        $user->roles()->sync(collect($request->get('role'))->all());

        return redirect()->route('user.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function permanentlyDestroy($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user.manager.index');
    }
}
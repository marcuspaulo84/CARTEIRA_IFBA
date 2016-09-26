<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('user_list');
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function roles($id)
    {
        $this->authorize('user_view_roles');
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.roles', compact('user', 'roles'));
    }

    public function storeRole(Request $request, $id)
    {
        $this->authorize('user_add_role');
        $user = User::find($id);
        $role = Role::findOrFail($request->all()['role_id']);
        $user->addRole($role);
        return redirect()->back();
    }

    public function revokeRole($id, $role_id)
    {
        $this->authorize('user_revoke_role');
        $user = User::find($id);
        $role = Role::findOrFail($role_id);
        $user->revokeRole($role);
        return redirect()->back();
    }

    private function prepareFields(Request $request)
    {
        $input = $request->all();
        if (isset($input['password'])) {
            $input['password'] = bcrypt($input['password']);
            return $input;
        }
        return $input;
    }

}

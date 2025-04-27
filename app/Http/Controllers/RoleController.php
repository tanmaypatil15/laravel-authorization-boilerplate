<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::get();
        return view('role-permission.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::get();
        $role = Role::get();
        return view('role-permission.roles.create', [
            'permissions' => $permissions,
            'role' => $role,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->role_name
        ]);

        return redirect('roles')->with('status', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($role->id);
        return view('role-permission.roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id,
            ],
            'permissions' => 'required|array',
        ]);

        $role->update([
            'name' => $request->role_name,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted Successfully');
    }
}

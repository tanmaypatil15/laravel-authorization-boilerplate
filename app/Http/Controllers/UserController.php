<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
            'is_active' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('status', 'User created successfully with roles and permissions.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user->load('roles', 'permissions');

        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|digits:10',
            'password' => 'nullable|string|min:8|max:20|confirmed',
            'password_confirmation' => 'nullable|same:password',
            'is_active' => 'nullable|boolean',
            'roles' => 'nullable|array',
            'permissions' => 'nullable|array',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function changePassword(User $user)
    {
        return view('users.change-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'current_password' => 'required|string',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        if ($request->password === $request->current_password) {
            return back()->withErrors(['password' => 'New password cannot be the same as the current password.']);
        }
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'Password confirmation does not match.']);
        }
        if (strlen($request->password) < 8) {
            return back()->withErrors(['password' => 'Password must be at least 8 characters long.']);
        }
        if (!preg_match('/[A-Z]/', $request->password)) {
            return back()->withErrors(['password' => 'Password must contain at least one uppercase letter.']);
        }
        if (!preg_match('/[a-z]/', $request->password)) {
            return back()->withErrors(['password' => 'Password must contain at least one lowercase letter.']);
        }
        if (!preg_match('/[0-9]/', $request->password)) {
            return back()->withErrors(['password' => 'Password must contain at least one number.']);
        }
        if (!preg_match('/[@$!%*?&]/', $request->password)) {
            return back()->withErrors(['password' => 'Password must contain at least one special character.']);
        }
        if (preg_match('/\s/', $request->password)) {
            return back()->withErrors(['password' => 'Password cannot contain spaces.']);
        }
        if (preg_match('/[\'\"\\\]/', $request->password)) {
            return back()->withErrors(['password' => 'Password cannot contain single or double quotes or backslashes.']);
        }
        if (preg_match('/[<>]/', $request->password)) {
            return back()->withErrors(['password' => 'Password cannot contain angle brackets.']);
        }


        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('users.index')->with('success', 'Password updated successfully.');
    }
}

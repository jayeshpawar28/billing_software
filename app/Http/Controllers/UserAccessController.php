<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccessController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::where('status', 'active')->get();
        return view('user_access.index', compact('users', 'roles'));
    }

    public function userRoles($userId)
    {
        $user = User::with('roles')->find($userId);
        $roles = Role::where('status', 'active')->get();
        $userRoleIds = $user->roles->pluck('id')->toArray();
        
        return view('user_access.user_roles', compact('user', 'roles', 'userRoleIds'));
    }

    public function assignRoles(Request $request, $userId)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user = User::find($userId);
        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('user_access.index')->with('success', 'User roles updated successfully.');
    }

    public function rolePermissions($roleId)
    {
        $role = Role::with('permissions')->find($roleId);
        $permissions = Permission::where('status', 'active')->get()->groupBy('module');
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        
        return view('user_access.role_permissions', compact('role', 'permissions', 'rolePermissionIds'));
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::find($roleId);
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('user_access.index')->with('success', 'Role permissions updated successfully.');
    }

    public function manageRoles()
    {
        $roles = Role::with('permissions')->get();
        return view('user_access.manage_roles', compact('roles'));
    }

    public function createRole()
    {
        return view('user_access.create_role');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'display_name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Role::create($request->all());

        return redirect()->route('user_access.manage_roles')->with('success', 'Role created successfully.');
    }

    public function editRole($roleId)
    {
        $role = Role::find($roleId);
        return view('user_access.edit_role', compact('role'));
    }

    public function updateRole(Request $request, $roleId)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $roleId,
            'display_name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $role = Role::find($roleId);
        $role->update($request->all());

        return redirect()->route('user_access.manage_roles')->with('success', 'Role updated successfully.');
    }

    public function deleteRole($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        return redirect()->route('user_access.manage_roles')->with('success', 'Role deleted successfully.');
    }
}

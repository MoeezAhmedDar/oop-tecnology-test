<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesHasPermission extends Controller
{
    public  function assignPermissions()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            return view('roles.roleshaspermissions')->with([
                'roles' => Role::where('name', '!=', 'Super Admin')->get(),
                'permissions' => Permission::where('id', '>', '1')->get(),
            ]);
        }
        abort(404);
    }
    public  function storePermissions(Request $request)
    {
        if (Auth::user()->hasRole('Super Admin')) {
            $request->validate([
                'role' => ['required'],
                'permission' => ['required'],
            ]);
            $role = Role::where('id', $request->role)->first();
            $role->syncPermissions($request->input('permission'));

            $messages['success'] = "Permissions Added Successfully";
            return  redirect()->back()
            ->with('messages', $messages);

        }
        abort(404);
    }
}

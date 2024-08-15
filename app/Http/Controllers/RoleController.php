<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $existingRole = Role::where('name', $request->input('name'))->first();
        if ($existingRole) {
            return redirect()->back()->with('error', 'El rol ya existe.');
        }

        $role = Role::create(['name' => $request->input('name')]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions'));
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $existingRole = Role::where('name', $request->input('name'))->where('id', '!=', $id)->first();
        if ($existingRole) {
            return redirect()->back()->with('error', 'El rol ya existe.');
        }
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        } else {
            $role->permissions()->sync([]);
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }
    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }
    
}

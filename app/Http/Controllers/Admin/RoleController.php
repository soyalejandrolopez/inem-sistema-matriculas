<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->route('admin.roles.index')
                        ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $role = Role::with('permissions')->findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $role = Role::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('admin.roles.index')
                        ->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        $role = Role::findOrFail($id);
        
        // Desacoplar todas las relaciones con los permisos
        $role->permissions()->detach();
        
        // Desacoplar todas las relaciones con los usuarios
        $role->users()->detach();
        
        $role->delete();

        return redirect()->route('admin.roles.index')
                        ->with('success', 'Rol eliminado exitosamente.');
    }
}

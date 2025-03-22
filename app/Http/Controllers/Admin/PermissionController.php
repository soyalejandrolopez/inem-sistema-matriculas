<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
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
        
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
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
        
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
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
            'name' => 'required|string|max:255|unique:permissions',
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if ($request->has('roles')) {
            $permission->roles()->attach($request->roles);
        }

        return redirect()->route('admin.permissions.index')
                        ->with('success', 'Permiso creado exitosamente.');
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
        
        $permission = Permission::with('roles')->findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
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
        
        $permission = Permission::findOrFail($id);
        $roles = Role::all();
        $permissionRoles = $permission->roles->pluck('id')->toArray();
        
        return view('admin.permissions.edit', compact('permission', 'roles', 'permissionRoles'));
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
        
        $permission = Permission::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if ($request->has('roles')) {
            $permission->roles()->sync($request->roles);
        } else {
            $permission->roles()->detach();
        }

        return redirect()->route('admin.permissions.index')
                        ->with('success', 'Permiso actualizado exitosamente.');
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
        
        $permission = Permission::findOrFail($id);
        
        // Desacoplar todas las relaciones con los roles
        $permission->roles()->detach();
        
        $permission->delete();

        return redirect()->route('admin.permissions.index')
                        ->with('success', 'Permiso eliminado exitosamente.');
    }
}

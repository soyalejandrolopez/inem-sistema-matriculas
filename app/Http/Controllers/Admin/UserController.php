<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        // Iniciar una consulta para obtener usuarios
        $query = User::query();
        
        // Buscar por nombre o email si se proporciona un término de búsqueda
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Filtrar por rol si se selecciona un rol
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        // Ordenar resultados
        if ($request->filled('order')) {
            switch ($request->order) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Orden predeterminado: más recientes primero
            $query->orderBy('created_at', 'desc');
        }
        
        // Obtener usuarios paginados
        $users = $query->paginate(10);
        
        // Mantener los parámetros de búsqueda en la paginación
        $users->appends($request->query());
        
        return view('admin.users.index', compact('users'));
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
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if ($request->has('roles')) {
            $user->roles()->attach($request->roles);
        }

        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario creado exitosamente.');
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
        
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
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
        
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
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
        
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
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
        
        // No permitir eliminar al usuario actual
        if (Auth::id() == $id) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'No puedes eliminar tu propio usuario.');
        }
        
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario eliminado exitosamente.');
    }
}

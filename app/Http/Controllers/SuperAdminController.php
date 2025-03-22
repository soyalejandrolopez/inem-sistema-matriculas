<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario es super admin o admin
        if (!in_array(Auth::user()->role, ['super_admin', 'admin'])) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        
        // Get some statistics for the dashboard
        // Filtrar para contar solo usuarios regulares (no admin, no super_admin)
        $userCount = User::where('role', 'user')->count();
        
        // Obtener la lista de los últimos 5 usuarios regulares
        $recentUsers = User::where('role', 'user')
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();
        
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'recentUsers' => $recentUsers
        ]);
    }
}

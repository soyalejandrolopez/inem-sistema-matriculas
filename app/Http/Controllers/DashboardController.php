<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mostrar el dashboard del usuario regular.
     */
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Si el usuario es super_admin o admin, redirigir al dashboard de administración
        if (in_array(Auth::user()->role, ['super_admin', 'admin'])) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('dashboard.index', [
            'user' => Auth::user()
        ]);
    }
}

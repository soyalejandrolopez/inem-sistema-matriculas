<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\SedeEducativa;
use App\Models\Grado;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEstudiantes = Estudiante::count();
        $totalSedes = SedeEducativa::count();
        $estudiantesPorGrado = Estudiante::select('grado_actual')
            ->selectRaw('count(*) as total')
            ->groupBy('grado_actual')
            ->get();
        $estudiantesPorSede = Estudiante::select('sede_educativa_id')
            ->selectRaw('count(*) as total')
            ->groupBy('sede_educativa_id')
            ->with('sedeEducativa')
            ->get();

        return view('admin.dashboard', compact(
            'totalEstudiantes',
            'totalSedes',
            'estudiantesPorGrado',
            'estudiantesPorSede'
        ));
    }
}

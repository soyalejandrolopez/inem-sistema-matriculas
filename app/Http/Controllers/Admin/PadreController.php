<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padre;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class PadreController extends Controller
{
    public function index()
    {
        $padres = Padre::with('estudiante')->paginate(10);
        return view('admin.padres.index', compact('padres'));
    }

    public function create()
    {
        $estudiantes = Estudiante::all();
        return view('admin.padres.create', compact('estudiantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre' => 'required|string|max:100',
            'numero_documento' => 'nullable|string|max:20',
            'profesion_ocupacion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        Padre::create($request->all());

        return redirect()->route('admin.padres.index')
            ->with('success', 'Padre creado exitosamente.');
    }

    public function show(Padre $padre)
    {
        $padre->load('estudiante');
        return view('admin.padres.show', compact('padre'));
    }

    public function edit(Padre $padre)
    {
        $estudiantes = Estudiante::all();
        return view('admin.padres.edit', compact('padre', 'estudiantes'));
    }

    public function update(Request $request, Padre $padre)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre' => 'required|string|max:100',
            'numero_documento' => 'nullable|string|max:20',
            'profesion_ocupacion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        $padre->update($request->all());

        return redirect()->route('admin.padres.index')
            ->with('success', 'Padre actualizado exitosamente.');
    }

    public function destroy(Padre $padre)
    {
        $padre->delete();
        return redirect()->route('admin.padres.index')
            ->with('success', 'Padre eliminado exitosamente.');
    }
}

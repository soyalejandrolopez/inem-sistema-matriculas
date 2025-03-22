<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Madre;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class MadreController extends Controller
{
    public function index()
    {
        $madres = Madre::with('estudiante')->paginate(10);
        return view('admin.madres.index', compact('madres'));
    }

    public function create()
    {
        $estudiantes = Estudiante::all();
        return view('admin.madres.create', compact('estudiantes'));
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

        Madre::create($request->all());

        return redirect()->route('admin.madres.index')
            ->with('success', 'Madre creada exitosamente.');
    }

    public function show(Madre $madre)
    {
        $madre->load('estudiante');
        return view('admin.madres.show', compact('madre'));
    }

    public function edit(Madre $madre)
    {
        $estudiantes = Estudiante::all();
        return view('admin.madres.edit', compact('madre', 'estudiantes'));
    }

    public function update(Request $request, Madre $madre)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre' => 'required|string|max:100',
            'numero_documento' => 'nullable|string|max:20',
            'profesion_ocupacion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        $madre->update($request->all());

        return redirect()->route('admin.madres.index')
            ->with('success', 'Madre actualizada exitosamente.');
    }

    public function destroy(Madre $madre)
    {
        $madre->delete();
        return redirect()->route('admin.madres.index')
            ->with('success', 'Madre eliminada exitosamente.');
    }
}

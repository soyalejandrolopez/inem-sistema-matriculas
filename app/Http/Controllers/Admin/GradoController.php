<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::paginate(10);
        return view('admin.grados.index', compact('grados'));
    }

    public function create()
    {
        return view('admin.grados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:grados',
        ]);

        Grado::create($request->all());

        return redirect()->route('admin.grados.index')
            ->with('success', 'Grado creado exitosamente.');
    }

    public function show(Grado $grado)
    {
        return view('admin.grados.show', compact('grado'));
    }

    public function edit(Grado $grado)
    {
        return view('admin.grados.edit', compact('grado'));
    }

    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:grados,nombre,' . $grado->id,
        ]);

        $grado->update($request->all());

        return redirect()->route('admin.grados.index')
            ->with('success', 'Grado actualizado exitosamente.');
    }

    public function destroy(Grado $grado)
    {
        try {
            $grado->delete();
            return redirect()->route('admin.grados.index')
                ->with('success', 'Grado eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.grados.index')
                ->with('error', 'No se puede eliminar este grado porque está en uso.');
        }
    }
}

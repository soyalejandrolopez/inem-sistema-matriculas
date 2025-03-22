<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrupoEtnico;
use Illuminate\Http\Request;

class GrupoEtnicoController extends Controller
{
    public function index()
    {
        $grupoEtnicos = GrupoEtnico::paginate(10);
        return view('admin.grupo_etnicos.index', compact('grupoEtnicos'));
    }

    public function create()
    {
        return view('admin.grupo_etnicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:grupo_etnicos',
        ]);

        GrupoEtnico::create($request->all());

        return redirect()->route('admin.grupo-etnicos.index')
            ->with('success', 'Grupo étnico creado exitosamente.');
    }

    public function show(GrupoEtnico $grupoEtnico)
    {
        return view('admin.grupo_etnicos.show', compact('grupoEtnico'));
    }

    public function edit(GrupoEtnico $grupoEtnico)
    {
        return view('admin.grupo_etnicos.edit', compact('grupoEtnico'));
    }

    public function update(Request $request, GrupoEtnico $grupoEtnico)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:grupo_etnicos,descripcion,' . $grupoEtnico->id,
        ]);

        $grupoEtnico->update($request->all());

        return redirect()->route('admin.grupo-etnicos.index')
            ->with('success', 'Grupo étnico actualizado exitosamente.');
    }

    public function destroy(GrupoEtnico $grupoEtnico)
    {
        try {
            $grupoEtnico->delete();
            return redirect()->route('admin.grupo-etnicos.index')
                ->with('success', 'Grupo étnico eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.grupo-etnicos.index')
                ->with('error', 'No se puede eliminar este grupo étnico porque está en uso.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::paginate(10);
        return view('admin.generos.index', compact('generos'));
    }

    public function create()
    {
        return view('admin.generos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:30|unique:generos',
        ]);

        Genero::create($request->all());

        return redirect()->route('admin.generos.index')
            ->with('success', 'Género creado exitosamente.');
    }

    public function show(Genero $genero)
    {
        return view('admin.generos.show', compact('genero'));
    }

    public function edit(Genero $genero)
    {
        return view('admin.generos.edit', compact('genero'));
    }

    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'descripcion' => 'required|string|max:30|unique:generos,descripcion,' . $genero->id,
        ]);

        $genero->update($request->all());

        return redirect()->route('admin.generos.index')
            ->with('success', 'Género actualizado exitosamente.');
    }

    public function destroy(Genero $genero)
    {
        try {
            $genero->delete();
            return redirect()->route('admin.generos.index')
                ->with('success', 'Género eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.generos.index')
                ->with('error', 'No se puede eliminar este género porque está en uso.');
        }
    }
}

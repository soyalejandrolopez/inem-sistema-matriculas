<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\SedeEducativa;
use Illuminate\Http\Request;

class SedeEducativaController extends Controller
{
    public function index()
    {
        $sedeEducativas = SedeEducativa::paginate(10);
        return view('admin.sede_educativas.index', compact('sedeEducativas'));
    }

    public function create()
    {
        return view('admin.sede_educativas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:sede_educativas',
        ]);

        SedeEducativa::create($request->all());

        return redirect()->route('admin.sede-educativas.index')
            ->with('success', 'Sede educativa creada exitosamente.');
    }

    public function show(SedeEducativa $sedeEducativa)
    {
        return view('admin.sede_educativas.show', compact('sedeEducativa'));
    }

    public function edit(SedeEducativa $sedeEducativa)
    {
        return view('admin.sede_educativas.edit', compact('sedeEducativa'));
    }

    public function update(Request $request, SedeEducativa $sedeEducativa)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:sede_educativas,nombre,' . $sedeEducativa->id,
        ]);

        $sedeEducativa->update($request->all());

        return redirect()->route('admin.sede-educativas.index')
            ->with('success', 'Sede educativa actualizada exitosamente.');
    }

    public function destroy(SedeEducativa $sedeEducativa)
    {
        try {
            $sedeEducativa->delete();
            return redirect()->route('admin.sede-educativas.index')
                ->with('success', 'Sede educativa eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sede-educativas.index')
                ->with('error', 'No se puede eliminar esta sede educativa porque está en uso.');
        }
    }
}

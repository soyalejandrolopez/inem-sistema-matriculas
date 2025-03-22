<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoSangre;
use Illuminate\Http\Request;

class TipoSangreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoSangres = TipoSangre::paginate(10);
        return view('admin.tipo_sangres.index', compact('tipoSangres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipo_sangres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:10|unique:tipo_sangres',
        ]);

        TipoSangre::create($request->all());

        return redirect()->route('admin.tipo-sangres.index')
            ->with('success', 'Tipo de sangre creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoSangre $tipoSangre)
    {
        return view('admin.tipo_sangres.show', compact('tipoSangre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoSangre $tipoSangre)
    {
        return view('admin.tipo_sangres.edit', compact('tipoSangre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoSangre $tipoSangre)
    {
        $request->validate([
            'tipo' => 'required|string|max:10|unique:tipo_sangres,tipo,' . $tipoSangre->id,
        ]);

        $tipoSangre->update($request->all());

        return redirect()->route('admin.tipo-sangres.index')
            ->with('success', 'Tipo de sangre actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoSangre $tipoSangre)
    {
        try {
            $tipoSangre->delete();
            return redirect()->route('admin.tipo-sangres.index')
                ->with('success', 'Tipo de sangre eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipo-sangres.index')
                ->with('error', 'No se puede eliminar este tipo de sangre porque está en uso.');
        }
    }
}

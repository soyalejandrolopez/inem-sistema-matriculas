<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;


class TipoDocumentoController extends Controller
{
    public function index()
    {
        $tipoDocumentos = TipoDocumento::paginate(10);
        return view('admin.tipo_documentos.index', compact('tipoDocumentos'));
    }

    public function create()
    {
        return view('admin.tipo_documentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:tipo_documentos',
        ]);

        TipoDocumento::create($request->all());

        return redirect()->route('admin.tipo-documentos.index')
            ->with('success', 'Tipo de documento creado exitosamente.');
    }

    public function show(TipoDocumento $tipoDocumento)
    {
        return view('admin.tipo_documentos.show', compact('tipoDocumento'));
    }

    public function edit(TipoDocumento $tipoDocumento)
    {
        return view('admin.tipo_documentos.edit', compact('tipoDocumento'));
    }

    public function update(Request $request, TipoDocumento $tipoDocumento)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:tipo_documentos,descripcion,' . $tipoDocumento->id,
        ]);

        $tipoDocumento->update($request->all());

        return redirect()->route('admin.tipo-documentos.index')
            ->with('success', 'Tipo de documento actualizado exitosamente.');
    }

    public function destroy(TipoDocumento $tipoDocumento)
    {
        try {
            $tipoDocumento->delete();
            return redirect()->route('admin.tipo-documentos.index')
                ->with('success', 'Tipo de documento eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipo-documentos.index')
                ->with('error', 'No se puede eliminar este tipo de documento porque está en uso.');
        }
    }
}

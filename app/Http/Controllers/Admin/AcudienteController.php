<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acudiente;
use App\Models\Estudiante;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class AcudienteController extends Controller
{
    public function index()
    {
        $acudientes = Acudiente::with(['estudiante', 'tipoDocumento'])->paginate(10);
        return view('admin.acudientes.index', compact('acudientes'));
    }

    public function create()
    {
        $estudiantes = Estudiante::all();
        $tipoDocumentos = TipoDocumento::all();
        return view('admin.acudientes.create', compact('estudiantes', 'tipoDocumentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre' => 'required|string|max:100',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:20',
            'lugar_expedicion' => 'nullable|string|max:100',
            'profesion_ocupacion' => 'nullable|string|max:100',
            'correo_electronico' => 'nullable|email|max:100',
            'direccion_residencia' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
        ]);

        Acudiente::create($request->all());

        return redirect()->route('admin.acudientes.index')
            ->with('success', 'Acudiente creado exitosamente.');
    }

    public function show(Acudiente $acudiente)
    {
        $acudiente->load(['estudiante', 'tipoDocumento']);
        return view('admin.acudientes.show', compact('acudiente'));
    }

    public function edit(Acudiente $acudiente)
    {
        $estudiantes = Estudiante::all();
        $tipoDocumentos = TipoDocumento::all();
        return view('admin.acudientes.edit', compact('acudiente', 'estudiantes', 'tipoDocumentos'));
    }

    public function update(Request $request, Acudiente $acudiente)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'nombre' => 'required|string|max:100',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:20',
            'lugar_expedicion' => 'nullable|string|max:100',
            'profesion_ocupacion' => 'nullable|string|max:100',
            'correo_electronico' => 'nullable|email|max:100',
            'direccion_residencia' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
        ]);

        $acudiente->update($request->all());

        return redirect()->route('admin.acudientes.index')
            ->with('success', 'Acudiente actualizado exitosamente.');
    }

    public function destroy(Acudiente $acudiente)
    {
        $acudiente->delete();
        return redirect()->route('admin.acudientes.index')
            ->with('success', 'Acudiente eliminado exitosamente.');
    }
}

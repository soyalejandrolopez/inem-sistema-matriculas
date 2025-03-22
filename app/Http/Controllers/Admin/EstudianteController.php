<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\TipoDocumento;
use App\Models\Genero;
use App\Models\TipoSangre;
use App\Models\Eps;
use App\Models\GrupoEtnico;
use App\Models\SedeEducativa;
use App\Models\Grado;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::with([
            'tipoDocumento', 'genero', 'tipoSangre',
            'eps', 'grupoEtnico', 'sedeEducativa'
        ])->paginate(10);
        
        return view('admin.estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $tipoDocumentos = TipoDocumento::all();
        $generos = Genero::all();
        $tipoSangres = TipoSangre::all();
        $epss = Eps::all();
        $grupoEtnicos = GrupoEtnico::all();
        $sedeEducativas = SedeEducativa::all();
        $grados = Grado::all();
        
        return view('admin.estudiantes.create', compact(
            'tipoDocumentos', 'generos', 'tipoSangres',
            'epss', 'grupoEtnicos', 'sedeEducativas', 'grados'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'apellidos' => 'required|string|max:100',
            'nombres' => 'required|string|max:100',
            'genero_id' => 'required|exists:generos,id',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:20|unique:estudiantes',
            'lugar_expedicion' => 'nullable|string|max:100',
            'codigo' => 'nullable|string|max:20',
            'telefono_principal' => 'nullable|string|max:20',
            'telefono_adicional' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'lugar_nacimiento' => 'nullable|string|max:100',
            'tipo_sangre_id' => 'nullable|exists:tipo_sangres,id',
            'discapacidad' => 'nullable|string|max:100',
            'otra_discapacidad' => 'nullable|string|max:100',
            'enfermedad_cronica' => 'nullable|string|max:100',
            'estado_embarazo' => 'required|in:Sí,No',
            'ciudad_municipio_residencia' => 'nullable|string|max:100',
            'direccion_residencia' => 'nullable|string|max:200',
            'barrio_vereda' => 'nullable|string|max:100',
            'comuna' => 'nullable|string|max:50',
            'eps_id' => 'nullable|exists:eps,id',
            'estrato_socioeconomico' => 'nullable|integer|min:1|max:6',
            'grupo_etnico_id' => 'nullable|exists:grupo_etnicos,id',
            'icbf' => 'required|in:Sí,No',
            'sisben' => 'nullable|string|max:50',
            'nivel_sisben' => 'nullable|string|max:50',
            'tipo_estudiante' => 'required|in:Nuevo,Antiguo,Reintegrado',
            'sede_educativa_id' => 'required|exists:sede_educativas,id',
            'grado_actual' => 'required|string|max:50',
            'grado_matricula' => 'required|string|max:50',
        ]);

        $estudiante = Estudiante::create($request->all());

        return redirect()->route('admin.estudiantes.index')
            ->with('success', 'Estudiante creado exitosamente.');
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load([
            'tipoDocumento', 'genero', 'tipoSangre',
            'eps', 'grupoEtnico', 'sedeEducativa',
            'acudientes', 'padre', 'madre'
        ]);
        
        return view('admin.estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $tipoDocumentos = TipoDocumento::all();
        $generos = Genero::all();
        $tipoSangres = TipoSangre::all();
        $epss = Eps::all();
        $grupoEtnicos = GrupoEtnico::all();
        $sedeEducativas = SedeEducativa::all();
        $grados = Grado::all();
        
        return view('admin.estudiantes.edit', compact(
            'estudiante', 'tipoDocumentos', 'generos', 'tipoSangres',
            'epss', 'grupoEtnicos', 'sedeEducativas', 'grados'
        ));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'apellidos' => 'required|string|max:100',
            'nombres' => 'required|string|max:100',
            'genero_id' => 'required|exists:generos,id',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:20|unique:estudiantes,numero_documento,' . $estudiante->id,
            'lugar_expedicion' => 'nullable|string|max:100',
            'codigo' => 'nullable|string|max:20',
            'telefono_principal' => 'nullable|string|max:20',
            'telefono_adicional' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'lugar_nacimiento' => 'nullable|string|max:100',
            'tipo_sangre_id' => 'nullable|exists:tipo_sangres,id',
            'discapacidad' => 'nullable|string|max:100',
            'otra_discapacidad' => 'nullable|string|max:100',
            'enfermedad_cronica' => 'nullable|string|max:100',
            'estado_embarazo' => 'required|in:Sí,No',
            'ciudad_municipio_residencia' => 'nullable|string|max:100',
            'direccion_residencia' => 'nullable|string|max:200',
            'barrio_vereda' => 'nullable|string|max:100',
            'comuna' => 'nullable|string|max:50',
            'eps_id' => 'nullable|exists:eps,id',
            'estrato_socioeconomico' => 'nullable|integer|min:1|max:6',
            'grupo_etnico_id' => 'nullable|exists:grupo_etnicos,id',
            'icbf' => 'required|in:Sí,No',
            'sisben' => 'nullable|string|max:50',
            'nivel_sisben' => 'nullable|string|max:50',
            'tipo_estudiante' => 'required|in:Nuevo,Antiguo,Reintegrado',
            'sede_educativa_id' => 'required|exists:sede_educativas,id',
            'grado_actual' => 'required|string|max:50',
            'grado_matricula' => 'required|string|max:50',
        ]);

        $estudiante->update($request->all());

        return redirect()->route('admin.estudiantes.index')
            ->with('success', 'Estudiante actualizado exitosamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        try {
            $estudiante->delete();
            return redirect()->route('admin.estudiantes.index')
                ->with('success', 'Estudiante eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.estudiantes.index')
                ->with('error', 'Hubo un error al eliminar el estudiante: ' . $e->getMessage());
        }
    }
}

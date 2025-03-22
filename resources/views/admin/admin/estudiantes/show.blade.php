@php
$fields = [
    // Información básica
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'apellidos', 'label' => 'Apellidos'],
    ['field' => 'nombres', 'label' => 'Nombres'],
    ['label' => 'Género', 'format' => function($item) {
        return $item->genero->descripcion;
    }],
    ['label' => 'Tipo de Documento', 'format' => function($item) {
        return $item->tipoDocumento->descripcion;
    }],
    ['field' => 'numero_documento', 'label' => 'Número de Documento'],
    ['field' => 'lugar_expedicion', 'label' => 'Lugar de Expedición'],
    ['field' => 'codigo', 'label' => 'Código'],
    ['field' => 'telefono_principal', 'label' => 'Teléfono Principal'],
    ['field' => 'telefono_adicional', 'label' => 'Teléfono Adicional'],
    
    // Información personal
    ['field' => 'fecha_nacimiento', 'label' => 'Fecha de Nacimiento', 'format' => function($item) {
        return $item->fecha_nacimiento ? $item->fecha_nacimiento->format('d/m/Y') : '';
    }],
    ['field' => 'lugar_nacimiento', 'label' => 'Lugar de Nacimiento'],
    ['label' => 'Tipo de Sangre', 'format' => function($item) {
        return $item->tipoSangre ? $item->tipoSangre->tipo : '';
    }],
    ['field' => 'discapacidad', 'label' => 'Discapacidad'],
    ['field' => 'otra_discapacidad', 'label' => 'Otra Discapacidad'],
    ['field' => 'enfermedad_cronica', 'label' => 'Enfermedad Crónica'],
    ['field' => 'estado_embarazo', 'label' => 'Estado de Embarazo'],
    
    // Información de residencia
    ['field' => 'ciudad_municipio_residencia', 'label' => 'Ciudad/Municipio de Residencia'],
    ['field' => 'direccion_residencia', 'label' => 'Dirección de Residencia'],
    ['field' => 'barrio_vereda', 'label' => 'Barrio/Vereda'],
    ['field' => 'comuna', 'label' => 'Comuna'],
    
    // Información adicional
    ['label' => 'EPS', 'format' => function($item) {
        return $item->eps ? $item->eps->nombre : '';
    }],
    ['field' => 'estrato_socioeconomico', 'label' => 'Estrato Socioeconómico'],
    ['label' => 'Grupo Étnico', 'format' => function($item) {
        return $item->grupoEtnico ? $item->grupoEtnico->descripcion : '';
    }],
    ['field' => 'icbf', 'label' => 'ICBF'],
    ['field' => 'sisben', 'label' => 'SISBEN'],
    ['field' => 'nivel_sisben', 'label' => 'Nivel SISBEN'],
    
    // Información académica
    ['field' => 'tipo_estudiante', 'label' => 'Tipo de Estudiante'],
    ['label' => 'Sede Educativa', 'format' => function($item) {
        return $item->sedeEducativa->nombre;
    }],
    ['field' => 'grado_actual', 'label' => 'Grado Actual'],
    ['field' => 'grado_matricula', 'label' => 'Grado Matrícula'],
    
    // Fechas
    ['field' => 'marca_temporal', 'label' => 'Fecha de Registro', 'format' => function($item) {
        return $item->marca_temporal->format('d/m/Y H:i');
    }],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }]
];

$title = 'Detalle Estudiante - INEM Sistema de Matrículas';
$header = 'Detalle Estudiante';
$backRoute = route('admin.estudiantes.index');
$editRoute = route('admin.estudiantes.edit', $estudiante);
$deleteRoute = route('admin.estudiantes.destroy', $estudiante);

// Contenido adicional para mostrar acudientes, padre y madre
$extraContent = '<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Acudientes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
if ($estudiante->acudientes->count() > 0) {
    foreach ($estudiante->acudientes as $acudiente) {
        $extraContent .= '<tr>
            <td>' . $acudiente->nombre . '</td>
            <td>' . $acudiente->telefono . '</td>
            <td>
                <a href="' . route('admin.acudientes.show', $acudiente) . '" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
        </tr>';
    }
} else {
    $extraContent .= '<tr><td colspan="3" class="text-center">No hay acudientes registrados</td></tr>';
}

$extraContent .= '</tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="' . route('admin.acudientes.create') . '?estudiante_id=' . $estudiante->id . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Agregar Acudiente
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Padre</h5>
            </div>
            <div class="card-body">';

if ($estudiante->padre) {
    $extraContent .= '<div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Nombre:</th>
                    <td>' . $estudiante->padre->nombre . '</td>
                </tr>
                <tr>
                    <th>Documento:</th>
                    <td>' . $estudiante->padre->numero_documento . '</td>
                </tr>
                <tr>
                    <th>Profesión/Ocupación:</th>
                    <td>' . $estudiante->padre->profesion_ocupacion . '</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>' . $estudiante->padre->telefono . '</td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="' . route('admin.padres.edit', $estudiante->padre) . '" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>';
} else {
    $extraContent .= '<p class="text-center">No hay información del padre</p>
    <div class="d-grid">
        <a href="' . route('admin.padres.create') . '?estudiante_id=' . $estudiante->id . '" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Agregar Padre
        </a>
    </div>';
}

$extraContent .= '</div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Madre</h5>
            </div>
            <div class="card-body">';

if ($estudiante->madre) {
    $extraContent .= '<div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Nombre:</th>
                    <td>' . $estudiante->madre->nombre . '</td>
                </tr>
                <tr>
                    <th>Documento:</th>
                    <td>' . $estudiante->madre->numero_documento . '</td>
                </tr>
                <tr>
                    <th>Profesión/Ocupación:</th>
                    <td>' . $estudiante->madre->profesion_ocupacion . '</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>' . $estudiante->madre->telefono . '</td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="' . route('admin.madres.edit', $estudiante->madre) . '" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>';
} else {
    $extraContent .= '<p class="text-center">No hay información de la madre</p>
    <div class="d-grid">
        <a href="' . route('admin.madres.create') . '?estudiante_id=' . $estudiante->id . '" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Agregar Madre
        </a>
    </div>';
}

$extraContent .= '</div>
        </div>
    </div>
</div>';
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $estudiante,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute,
    'extraContent' => $extraContent
]) 
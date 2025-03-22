@php
$fields = [
    // Información básica
    [
        'name' => 'apellidos',
        'label' => 'Apellidos',
        'type' => 'text',
        'required' => true
    ],
    [
        'name' => 'nombres',
        'label' => 'Nombres',
        'type' => 'text',
        'required' => true
    ],
    [
        'name' => 'genero_id',
        'label' => 'Género',
        'type' => 'select',
        'options' => $generos,
        'option_value' => 'id',
        'option_text' => 'descripcion',
        'required' => true
    ],
    [
        'name' => 'tipo_documento_id',
        'label' => 'Tipo de Documento',
        'type' => 'select',
        'options' => $tipoDocumentos,
        'option_value' => 'id',
        'option_text' => 'descripcion',
        'required' => true
    ],
    [
        'name' => 'numero_documento',
        'label' => 'Número de Documento',
        'type' => 'text',
        'required' => true
    ],
    [
        'name' => 'lugar_expedicion',
        'label' => 'Lugar de Expedición',
        'type' => 'text'
    ],
    [
        'name' => 'codigo',
        'label' => 'Código',
        'type' => 'text'
    ],
    [
        'name' => 'telefono_principal',
        'label' => 'Teléfono Principal',
        'type' => 'text'
    ],
    [
        'name' => 'telefono_adicional',
        'label' => 'Teléfono Adicional',
        'type' => 'text'
    ],
    
    // Información personal
    [
        'name' => 'fecha_nacimiento',
        'label' => 'Fecha de Nacimiento',
        'type' => 'date'
    ],
    [
        'name' => 'lugar_nacimiento',
        'label' => 'Lugar de Nacimiento',
        'type' => 'text'
    ],
    [
        'name' => 'tipo_sangre_id',
        'label' => 'Tipo de Sangre',
        'type' => 'select',
        'options' => $tipoSangres,
        'option_value' => 'id',
        'option_text' => 'tipo'
    ],
    [
        'name' => 'discapacidad',
        'label' => 'Discapacidad',
        'type' => 'text'
    ],
    [
        'name' => 'otra_discapacidad',
        'label' => 'Otra Discapacidad',
        'type' => 'text'
    ],
    [
        'name' => 'enfermedad_cronica',
        'label' => 'Enfermedad Crónica',
        'type' => 'text'
    ],
    [
        'name' => 'estado_embarazo',
        'label' => 'Estado de Embarazo',
        'type' => 'radio',
        'options' => [
            ['value' => 'Sí', 'label' => 'Sí'],
            ['value' => 'No', 'label' => 'No']
        ],
        'required' => true
    ],
    
    // Información de residencia
    [
        'name' => 'ciudad_municipio_residencia',
        'label' => 'Ciudad/Municipio de Residencia',
        'type' => 'text'
    ],
    [
        'name' => 'direccion_residencia',
        'label' => 'Dirección de Residencia',
        'type' => 'text'
    ],
    [
        'name' => 'barrio_vereda',
        'label' => 'Barrio/Vereda',
        'type' => 'text'
    ],
    [
        'name' => 'comuna',
        'label' => 'Comuna',
        'type' => 'text'
    ],
    
    // Información adicional
    [
        'name' => 'eps_id',
        'label' => 'EPS',
        'type' => 'select',
        'options' => $epss,
        'option_value' => 'id',
        'option_text' => 'nombre'
    ],
    [
        'name' => 'estrato_socioeconomico',
        'label' => 'Estrato Socioeconómico',
        'type' => 'number'
    ],
    [
        'name' => 'grupo_etnico_id',
        'label' => 'Grupo Étnico',
        'type' => 'select',
        'options' => $grupoEtnicos,
        'option_value' => 'id',
        'option_text' => 'descripcion'
    ],
    [
        'name' => 'icbf',
        'label' => 'ICBF',
        'type' => 'radio',
        'options' => [
            ['value' => 'Sí', 'label' => 'Sí'],
            ['value' => 'No', 'label' => 'No']
        ],
        'required' => true
    ],
    [
        'name' => 'sisben',
        'label' => 'SISBEN',
        'type' => 'text'
    ],
    [
        'name' => 'nivel_sisben',
        'label' => 'Nivel SISBEN',
        'type' => 'text'
    ],
    
    // Información académica
    [
        'name' => 'tipo_estudiante',
        'label' => 'Tipo de Estudiante',
        'type' => 'select',
        'options' => [
            ['id' => 'Nuevo', 'descripcion' => 'Nuevo'],
            ['id' => 'Antiguo', 'descripcion' => 'Antiguo'],
            ['id' => 'Reintegrado', 'descripcion' => 'Reintegrado']
        ],
        'option_value' => 'id',
        'option_text' => 'descripcion',
        'required' => true
    ],
    [
        'name' => 'sede_educativa_id',
        'label' => 'Sede Educativa',
        'type' => 'select',
        'options' => $sedeEducativas,
        'option_value' => 'id',
        'option_text' => 'nombre',
        'required' => true
    ],
    [
        'name' => 'grado_actual',
        'label' => 'Grado Actual',
        'type' => 'text',
        'required' => true
    ],
    [
        'name' => 'grado_matricula',
        'label' => 'Grado Matrícula',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Estudiante - INEM Sistema de Matrículas';
$header = 'Editar Estudiante';
$submitRoute = route('admin.estudiantes.update', $estudiante);
$backRoute = route('admin.estudiantes.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $estudiante
]) 
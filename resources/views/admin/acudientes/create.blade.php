@php
$fields = [
    [
        'name' => 'estudiante_id',
        'label' => 'Estudiante',
        'type' => 'select',
        'options' => $estudiantes,
        'option_value' => 'id',
        'option_text' => function($estudiante) {
            return $estudiante->apellidos . ' ' . $estudiante->nombres . ' - ' . $estudiante->numero_documento;
        },
        'required' => true
    ],
    [
        'name' => 'nombre',
        'label' => 'Nombre Completo',
        'type' => 'text',
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
        'name' => 'profesion_ocupacion',
        'label' => 'Profesión/Ocupación',
        'type' => 'text'
    ],
    [
        'name' => 'correo_electronico',
        'label' => 'Correo Electrónico',
        'type' => 'email'
    ],
    [
        'name' => 'direccion_residencia',
        'label' => 'Dirección de Residencia',
        'type' => 'text'
    ],
    [
        'name' => 'telefono',
        'label' => 'Teléfono',
        'type' => 'text'
    ]
];

$title = 'Crear Acudiente - INEM Sistema de Matrículas';
$header = 'Crear Acudiente';
$submitRoute = route('admin.acudientes.store');
$backRoute = route('admin.acudientes.index');
$isEdit = false;

// Si se pasa un ID de estudiante en la URL, seleccionamos ese por defecto
if (request()->has('estudiante_id')) {
    foreach ($fields as &$field) {
        if ($field['name'] == 'estudiante_id') {
            $field['value'] = request()->estudiante_id;
            break;
        }
    }
}
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit
]) 
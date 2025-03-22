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
        'name' => 'numero_documento',
        'label' => 'Número de Documento',
        'type' => 'text'
    ],
    [
        'name' => 'profesion_ocupacion',
        'label' => 'Profesión/Ocupación',
        'type' => 'text'
    ],
    [
        'name' => 'telefono',
        'label' => 'Teléfono',
        'type' => 'text'
    ]
];

$title = 'Crear Padre - INEM Sistema de Matrículas';
$header = 'Crear Padre';
$submitRoute = route('admin.padres.store');
$backRoute = route('admin.padres.index');
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
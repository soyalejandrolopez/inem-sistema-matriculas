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

$title = 'Editar Padre - INEM Sistema de Matrículas';
$header = 'Editar Padre';
$submitRoute = route('admin.padres.update', $padre);
$backRoute = route('admin.padres.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $padre
]) 
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

$title = 'Editar Acudiente - INEM Sistema de Matrículas';
$header = 'Editar Acudiente';
$submitRoute = route('admin.acudientes.update', $acudiente);
$backRoute = route('admin.acudientes.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $acudiente
]) 
@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Grupo Étnico - INEM Sistema de Matrículas';
$header = 'Crear Grupo Étnico';
$submitRoute = route('admin.grupo-etnicos.store');
$backRoute = route('admin.grupo-etnicos.index');
$isEdit = false;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit
]) 
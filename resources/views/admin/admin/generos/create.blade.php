@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Género - INEM Sistema de Matrículas';
$header = 'Crear Género';
$submitRoute = route('admin.generos.store');
$backRoute = route('admin.generos.index');
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
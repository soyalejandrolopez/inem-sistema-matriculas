@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre del Grado',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Grado - INEM Sistema de Matrículas';
$header = 'Crear Grado';
$submitRoute = route('admin.grados.store');
$backRoute = route('admin.grados.index');
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
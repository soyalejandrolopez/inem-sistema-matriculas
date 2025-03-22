@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre de la Sede',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Sede Educativa - INEM Sistema de Matrículas';
$header = 'Crear Sede Educativa';
$submitRoute = route('admin.sede-educativas.store');
$backRoute = route('admin.sede-educativas.index');
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
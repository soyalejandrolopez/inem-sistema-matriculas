@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre de la Sede',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Sede Educativa - INEM Sistema de Matrículas';
$header = 'Editar Sede Educativa';
$submitRoute = route('admin.sede-educativas.update', $sedeEducativa);
$backRoute = route('admin.sede-educativas.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $sedeEducativa
]) 
@php
$fields = [
    [
        'name' => 'tipo',
        'label' => 'Tipo de Sangre',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Tipo de Sangre - INEM Sistema de Matrículas';
$header = 'Crear Tipo de Sangre';
$submitRoute = route('admin.tipo-sangres.store');
$backRoute = route('admin.tipo-sangres.index');
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
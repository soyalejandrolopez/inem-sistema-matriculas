@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre de la EPS',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear EPS - INEM Sistema de Matrículas';
$header = 'Crear EPS';
$submitRoute = route('admin.eps.store');
$backRoute = route('admin.eps.index');
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
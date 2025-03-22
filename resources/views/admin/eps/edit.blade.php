@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre de la EPS',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar EPS - INEM Sistema de Matrículas';
$header = 'Editar EPS';
$submitRoute = route('admin.eps.update', $ep);
$backRoute = route('admin.eps.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $ep
]) 
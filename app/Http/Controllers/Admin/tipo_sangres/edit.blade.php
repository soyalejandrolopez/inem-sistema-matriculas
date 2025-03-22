@php
$fields = [
    [
        'name' => 'tipo',
        'label' => 'Tipo de Sangre',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Tipo de Sangre - INEM Sistema de Matrículas';
$header = 'Editar Tipo de Sangre';
$submitRoute = route('admin.tipo-sangres.update', $tipoSangre);
$backRoute = route('admin.tipo-sangres.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $tipoSangre
]) 
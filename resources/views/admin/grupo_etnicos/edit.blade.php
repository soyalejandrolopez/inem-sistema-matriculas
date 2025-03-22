@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Grupo Étnico - INEM Sistema de Matrículas';
$header = 'Editar Grupo Étnico';
$submitRoute = route('admin.grupo-etnicos.update', $grupoEtnico);
$backRoute = route('admin.grupo-etnicos.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $grupoEtnico
]) 
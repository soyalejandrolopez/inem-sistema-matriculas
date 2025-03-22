@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Crear Tipo de Documento - INEM Sistema de Matrículas';
$header = 'Crear Tipo de Documento';
$submitRoute = route('admin.tipo-documentos.store');
$backRoute = route('admin.tipo-documentos.index');
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
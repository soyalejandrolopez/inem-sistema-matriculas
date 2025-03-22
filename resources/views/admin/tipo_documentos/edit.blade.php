@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Tipo de Documento - INEM Sistema de Matrículas';
$header = 'Editar Tipo de Documento';
$submitRoute = route('admin.tipo-documentos.update', $tipoDocumento);
$backRoute = route('admin.tipo-documentos.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $tipoDocumento
]) 
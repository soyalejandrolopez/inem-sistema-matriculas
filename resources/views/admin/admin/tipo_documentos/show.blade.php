@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'descripcion', 'label' => 'Descripción'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Tipo de Documento - INEM Sistema de Matrículas';
$header = 'Detalle Tipo de Documento';
$backRoute = route('admin.tipo-documentos.index');
$editRoute = route('admin.tipo-documentos.edit', $tipoDocumento);
$deleteRoute = route('admin.tipo-documentos.destroy', $tipoDocumento);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $tipoDocumento,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
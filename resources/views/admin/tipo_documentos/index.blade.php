@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'descripcion', 'label' => 'Descripción'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Tipos de Documento - INEM Sistema de Matrículas';
$header = 'Listado de Tipos de Documento';
$createRoute = 'admin.tipo-documentos.create';
$showRoute = 'admin.tipo-documentos.show';
$editRoute = 'admin.tipo-documentos.edit';
$deleteRoute = 'admin.tipo-documentos.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $tipoDocumentos,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
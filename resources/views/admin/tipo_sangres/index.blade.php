@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'tipo', 'label' => 'Tipo de Sangre'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Tipos de Sangre - INEM Sistema de Matrículas';
$header = 'Listado de Tipos de Sangre';
$createRoute = 'admin.tipo-sangres.create';
$showRoute = 'admin.tipo-sangres.show';
$editRoute = 'admin.tipo-sangres.edit';
$deleteRoute = 'admin.tipo-sangres.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $tipoSangres,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
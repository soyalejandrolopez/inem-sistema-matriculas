@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'descripcion', 'label' => 'Descripción'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Géneros - INEM Sistema de Matrículas';
$header = 'Listado de Géneros';
$createRoute = 'admin.generos.create';
$showRoute = 'admin.generos.show';
$editRoute = 'admin.generos.edit';
$deleteRoute = 'admin.generos.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $generos,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
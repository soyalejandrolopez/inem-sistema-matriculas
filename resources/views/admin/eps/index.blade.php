@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre EPS'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'EPS - INEM Sistema de Matrículas';
$header = 'Listado de EPS';
$createRoute = 'admin.eps.index';
$showRoute = 'admin.eps.show';
$editRoute = 'admin.eps.edit';
$deleteRoute = 'admin.eps.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $epss,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
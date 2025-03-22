@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre Grado'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Grados - INEM Sistema de Matrículas';
$header = 'Listado de Grados';
$createRoute = 'admin.grados.create';
$showRoute = 'admin.grados.show';
$editRoute = 'admin.grados.edit';
$deleteRoute = 'admin.grados.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $grados,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
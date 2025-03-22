@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'descripcion', 'label' => 'Descripción'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Grupos Étnicos - INEM Sistema de Matrículas';
$header = 'Listado de Grupos Étnicos';
$createRoute = 'admin.grupo-etnicos.create';
$showRoute = 'admin.grupo-etnicos.show';
$editRoute = 'admin.grupo-etnicos.edit';
$deleteRoute = 'admin.grupo-etnicos.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $grupoEtnicos,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
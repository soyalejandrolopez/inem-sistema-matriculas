@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre Sede'],
    ['field' => 'created_at', 'label' => 'Fecha Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
];

$title = 'Sedes Educativas - INEM Sistema de Matrículas';
$header = 'Listado de Sedes Educativas';
$createRoute = 'admin.sede-educativas.create';
$showRoute = 'admin.sede-educativas.show';
$editRoute = 'admin.sede-educativas.edit';
$deleteRoute = 'admin.sede-educativas.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $sedeEducativas,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
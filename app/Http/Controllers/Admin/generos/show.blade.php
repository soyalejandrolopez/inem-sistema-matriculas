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

$title = 'Detalle Género - INEM Sistema de Matrículas';
$header = 'Detalle Género';
$backRoute = route('admin.generos.index');
$editRoute = route('admin.generos.edit', $genero);
$deleteRoute = route('admin.generos.destroy', $genero);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $genero,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
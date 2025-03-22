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

$title = 'Detalle Grupo Étnico - INEM Sistema de Matrículas';
$header = 'Detalle Grupo Étnico';
$backRoute = route('admin.grupo-etnicos.index');
$editRoute = route('admin.grupo-etnicos.edit', $grupoEtnico);
$deleteRoute = route('admin.grupo-etnicos.destroy', $grupoEtnico);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $grupoEtnico,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
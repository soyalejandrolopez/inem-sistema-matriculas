@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre de la EPS'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle EPS - INEM Sistema de Matrículas';
$header = 'Detalle EPS';
$backRoute = route('admin.eps.index');
$editRoute = route('admin.eps.edit', $ep);
$deleteRoute = route('admin.eps.destroy', $ep);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $ep,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
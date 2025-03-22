@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre del Grado'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Grado - INEM Sistema de Matrículas';
$header = 'Detalle Grado';
$backRoute = route('admin.grados.index');
$editRoute = route('admin.grados.edit', $grado);
$deleteRoute = route('admin.grados.destroy', $grado);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $grado,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
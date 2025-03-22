@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'tipo', 'label' => 'Tipo de Sangre'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Tipo de Sangre - INEM Sistema de Matrículas';
$header = 'Detalle Tipo de Sangre';
$backRoute = route('admin.tipo-sangres.index');
$editRoute = route('admin.tipo-sangres.edit', $tipoSangre);
$deleteRoute = route('admin.tipo-sangres.destroy', $tipoSangre);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $tipoSangre,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
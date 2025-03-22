@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre de la Sede'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Sede Educativa - INEM Sistema de Matrículas';
$header = 'Detalle Sede Educativa';
$backRoute = route('admin.sede-educativas.index');
$editRoute = route('admin.sede-educativas.edit', $sedeEducativa);
$deleteRoute = route('admin.sede-educativas.destroy', $sedeEducativa);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $sedeEducativa,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
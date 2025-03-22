@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['label' => 'Estudiante', 'format' => function($item) {
        return $item->estudiante->apellidos . ' ' . $item->estudiante->nombres;
    }],
    ['field' => 'nombre', 'label' => 'Nombre'],
    ['field' => 'numero_documento', 'label' => 'Número de Documento'],
    ['field' => 'profesion_ocupacion', 'label' => 'Profesión/Ocupación'],
    ['field' => 'telefono', 'label' => 'Teléfono'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Madre - INEM Sistema de Matrículas';
$header = 'Detalle Madre';
$backRoute = route('admin.madres.index');
$editRoute = route('admin.madres.edit', $madre);
$deleteRoute = route('admin.madres.destroy', $madre);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $madre,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
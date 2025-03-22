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

$title = 'Detalle Padre - INEM Sistema de Matrículas';
$header = 'Detalle Padre';
$backRoute = route('admin.padres.index');
$editRoute = route('admin.padres.edit', $padre);
$deleteRoute = route('admin.padres.destroy', $padre);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $padre,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
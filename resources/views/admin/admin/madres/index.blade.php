@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'nombre', 'label' => 'Nombre'],
    [
        'label' => 'Estudiante', 
        'format' => function($item) {
            return $item->estudiante->apellidos . ' ' . $item->estudiante->nombres;
        }
    ],
    ['field' => 'numero_documento', 'label' => 'Documento'],
    ['field' => 'profesion_ocupacion', 'label' => 'Profesión/Ocupación'],
    ['field' => 'telefono', 'label' => 'Teléfono'],
];

$title = 'Madres - INEM Sistema de Matrículas';
$header = 'Listado de Madres';
$createRoute = 'admin.madres.create';
$showRoute = 'admin.madres.show';
$editRoute = 'admin.madres.edit';
$deleteRoute = 'admin.madres.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $madres,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
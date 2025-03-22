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

$title = 'Padres - INEM Sistema de Matrículas';
$header = 'Listado de Padres';
$createRoute = 'admin.padres.create';
$showRoute = 'admin.padres.show';
$editRoute = 'admin.padres.edit';
$deleteRoute = 'admin.padres.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $padres,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
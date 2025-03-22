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
    ['field' => 'telefono', 'label' => 'Teléfono'],
];

$title = 'Acudientes - INEM Sistema de Matrículas';
$header = 'Listado de Acudientes';
$createRoute = 'admin.acudientes.create';
$showRoute = 'admin.acudientes.show';
$editRoute = 'admin.acudientes.edit';
$deleteRoute = 'admin.acudientes.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $acudientes,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
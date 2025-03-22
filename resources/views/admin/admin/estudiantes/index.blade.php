@php
$columns = [
    ['field' => 'id', 'label' => 'ID'],
    ['field' => 'apellidos', 'label' => 'Apellidos'],
    ['field' => 'nombres', 'label' => 'Nombres'],
    ['field' => 'numero_documento', 'label' => 'Documento'],
    [
        'label' => 'Género', 
        'format' => function($item) {
            return $item->genero->descripcion;
        }
    ],
    [
        'label' => 'Sede', 
        'format' => function($item) {
            return $item->sedeEducativa->nombre;
        }
    ],
    ['field' => 'grado_actual', 'label' => 'Grado Actual'],
];

$title = 'Estudiantes - INEM Sistema de Matrículas';
$header = 'Listado de Estudiantes';
$createRoute = 'admin.estudiantes.create';
$showRoute = 'admin.estudiantes.show';
$editRoute = 'admin.estudiantes.edit';
$deleteRoute = 'admin.estudiantes.destroy';
@endphp

@include('admin.components.crud-index', [
    'title' => $title,
    'header' => $header,
    'columns' => $columns,
    'items' => $estudiantes,
    'createRoute' => $createRoute,
    'showRoute' => $showRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
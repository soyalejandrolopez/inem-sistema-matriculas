@php
$fields = [
    [
        'name' => 'descripcion',
        'label' => 'Descripción',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Género - INEM Sistema de Matrículas';
$header = 'Editar Género';
$submitRoute = route('admin.generos.update', $genero);
$backRoute = route('admin.generos.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $genero
]) 
@php
$fields = [
    [
        'name' => 'nombre',
        'label' => 'Nombre del Grado',
        'type' => 'text',
        'required' => true
    ]
];

$title = 'Editar Grado - INEM Sistema de Matrículas';
$header = 'Editar Grado';
$submitRoute = route('admin.grados.update', $grado);
$backRoute = route('admin.grados.index');
$isEdit = true;
@endphp

@include('admin.components.crud-form', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'submitRoute' => $submitRoute,
    'backRoute' => $backRoute,
    'isEdit' => $isEdit,
    'item' => $grado
]) 
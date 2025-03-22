@php
$fields = [
    ['field' => 'id', 'label' => 'ID'],
    ['label' => 'Estudiante', 'format' => function($item) {
        return $item->estudiante->apellidos . ' ' . $item->estudiante->nombres;
    }],
    ['field' => 'nombre', 'label' => 'Nombre'],
    ['label' => 'Tipo de Documento', 'format' => function($item) {
        return $item->tipoDocumento->descripcion;
    }],
    ['field' => 'numero_documento', 'label' => 'Número de Documento'],
    ['field' => 'lugar_expedicion', 'label' => 'Lugar de Expedición'],
    ['field' => 'profesion_ocupacion', 'label' => 'Profesión/Ocupación'],
    ['field' => 'correo_electronico', 'label' => 'Correo Electrónico'],
    ['field' => 'direccion_residencia', 'label' => 'Dirección de Residencia'],
    ['field' => 'telefono', 'label' => 'Teléfono'],
    ['field' => 'created_at', 'label' => 'Fecha de Creación', 'format' => function($item) {
        return $item->created_at->format('d/m/Y H:i');
    }],
    ['field' => 'updated_at', 'label' => 'Última Actualización', 'format' => function($item) {
        return $item->updated_at->format('d/m/Y H:i');
    }],
];

$title = 'Detalle Acudiente - INEM Sistema de Matrículas';
$header = 'Detalle Acudiente';
$backRoute = route('admin.acudientes.index');
$editRoute = route('admin.acudientes.edit', $acudiente);
$deleteRoute = route('admin.acudientes.destroy', $acudiente);
@endphp

@include('admin.components.crud-show', [
    'title' => $title,
    'header' => $header,
    'fields' => $fields,
    'item' => $acudiente,
    'backRoute' => $backRoute,
    'editRoute' => $editRoute,
    'deleteRoute' => $deleteRoute
]) 
@extends('layouts.admin')

@section('title', $title ?? 'Detalle')

@section('header', $header ?? 'Detalle')

@section('header_buttons')
<div class="btn-group" role="group">
    <a href="{{ $backRoute }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    <a href="{{ $editRoute }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i> Editar
    </a>
    <form action="{{ $deleteRoute }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este registro?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    @foreach($fields as $field)
                        <tr>
                            <th style="width: 30%">{{ $field['label'] }}:</th>
                            <td>
                                @if(isset($field['format']))
                                    {!! $field['format']($item) !!}
                                @else
                                    {{ $item->{$field['field']} }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(isset($extraContent))
    {!! $extraContent !!}
@endif
@endsection 
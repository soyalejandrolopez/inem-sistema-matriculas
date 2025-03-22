@extends('layouts.admin')

@section('title', $title ?? 'Listado')

@section('header', $header ?? 'Listado')

@section('header_buttons')
<a href="{{ $createRoute }}" class="btn btn-sm btn-primary">
    <i class="fas fa-plus"></i> Crear Nuevo
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{ $column['label'] }}</th>
                        @endforeach
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            @foreach($columns as $column)
                                <td>
                                    @if(isset($column['format']))
                                        {!! $column['format']($item) !!}
                                    @else
                                        {{ $item->{$column['field']} }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route($showRoute, $item) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route($editRoute, $item) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route($deleteRoute, $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="text-center">No hay registros para mostrar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($items->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 
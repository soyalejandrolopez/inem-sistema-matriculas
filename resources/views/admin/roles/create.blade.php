@extends('admin.layout')

@section('title', 'Crear Nuevo Rol')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5>Crear Nuevo Rol</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nombre *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">El nombre debe ser único y se usará como identificador del rol.</div>
            </div>
            
            <div class="mb-3">
                <label for="display_name" class="form-label">Nombre de Presentación</label>
                <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" value="{{ old('display_name') }}">
                @error('display_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Nombre amigable para mostrar en la interfaz.</div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Permisos</label>
                <div class="card">
                    <div class="card-body">
                        @forelse($permissions as $permission)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->display_name ?? $permission->name }}
                                    @if($permission->description)
                                        <small class="text-muted d-block">{{ $permission->description }}</small>
                                    @endif
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">No hay permisos disponibles.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Rol</button>
            </div>
        </form>
    </div>
</div>
@endsection 
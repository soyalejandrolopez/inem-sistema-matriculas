@extends('admin.layout')

@section('title', 'Crear Nuevo Permiso')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5>Crear Nuevo Permiso</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nombre *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">El nombre debe ser único y se usará como identificador del permiso.</div>
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
                <label class="form-label">Asignar a Roles</label>
                <div class="card">
                    <div class="card-body">
                        @forelse($roles as $role)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    {{ $role->display_name ?? $role->name }}
                                    @if($role->description)
                                        <small class="text-muted d-block">{{ $role->description }}</small>
                                    @endif
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">No hay roles disponibles.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Permiso</button>
            </div>
        </form>
    </div>
</div>
@endsection 
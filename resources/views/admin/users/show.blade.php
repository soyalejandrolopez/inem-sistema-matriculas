@extends('admin.layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5>Detalles del Usuario</h5>
        <div>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted">Información básica</h6>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Rol principal</th>
                        <td>
                            <span class="badge bg-{{ $user->role === 'super_admin' ? 'danger' : ($user->role === 'admin' ? 'primary' : 'secondary') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de creación</th>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Última actualización</th>
                        <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Roles asignados</h6>
                <div class="card">
                    <div class="card-body">
                        @if($user->roles->count() > 0)
                            <ul class="list-group">
                                @foreach($user->roles as $role)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $role->display_name ?? $role->name }}</strong>
                                            @if($role->description)
                                                <p class="text-muted mb-0 small">{{ $role->description }}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No tiene roles adicionales asignados.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@extends('admin.layout')

@section('title', 'Panel de Administración')

@section('content')
<!-- Stats Cards -->
<div class="row">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Total Estudiantes</h5>
                    <h2>{{ $userCount }}</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Matrículas Activas</h5>
                    <h2>0</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Solicitudes Pendientes</h5>
                    <h2>0</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Students -->
<div class="card mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5>Estudiantes Recientes</h5>
        @if(Auth::user()->role === 'super_admin')
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
            Ver Todos <i class="bi bi-arrow-right"></i>
        </a>
        @endif
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_users'))
                        <div class="btn-group">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No hay estudiantes registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 
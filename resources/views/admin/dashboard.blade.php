@extends('admin.layout')

@section('title', 'Panel de Administración')

@section('content')
<!-- Stats Cards -->
<div class="row">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Total Usuarios</h5>
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

<!-- Recent Activity -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5>Actividad Reciente</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-center">No hay actividad reciente</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 
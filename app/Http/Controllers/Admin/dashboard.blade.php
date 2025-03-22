@extends('admin.layout')

@section('title', 'Panel de Administración')

@section('content')
<!-- Stats Cards -->
<div class="row">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="stats-info">
                    <h5 class="card-title">Total Estudiantes</h5>
                    <h2>{{ $totalEstudiantes }}</h2>
                </div>
                <div class="stats-icon students">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="stats-info">
                    <h5 class="card-title">Matrículas Activas</h5>
                    <h2>0</h2>
                </div>
                <div class="stats-icon enrollments">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="stats-info">
                    <h5 class="card-title">Total Sedes</h5>
                    <h2>{{ $totalSedes }}</h2>
                </div>
                <div class="stats-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="stats-info">
                    <h5 class="card-title">Estudiantes por Grado</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Grado</th>
                                <th>Total Estudiantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantesPorGrado as $grado)
                            <tr>
                                <td>{{ $grado->grado_actual }}</td>
                                <td>{{ $grado->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="stats-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="stats-info">
                    <h5 class="card-title">Estudiantes por Sede</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sede</th>
                                <th>Total Estudiantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantesPorSede as $sede)
                            <tr>
                                <td>{{ $sede->sedeEducativa->nombre }}</td>
                                <td>{{ $sede->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="stats-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Students -->
@endsection 
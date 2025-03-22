@extends('dashboard.layout')

@section('title', 'Dashboard Estudiante')

@section('content')
<!-- Stats Cards -->
<div class="row">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Estado de Matrícula</h5>
                    <h2>Pendiente</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Documentos</h5>
                    <h2>3 / 5</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Notificaciones</h5>
                    <h2>2</h2>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-bell"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Progress Section -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5>Progreso de Matrícula</h5>
    </div>
    <div class="card-body">
        <div class="progress mb-3" style="height: 25px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
        </div>
        <div class="list-group mt-3">
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Formulario de inscripción
                </div>
                <span class="badge bg-success rounded-pill">Completado</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Documentos personales
                </div>
                <span class="badge bg-success rounded-pill">Completado</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Certificado de estudios
                </div>
                <span class="badge bg-success rounded-pill">Completado</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                    Pago de matrícula
                </div>
                <span class="badge bg-warning rounded-pill">Pendiente</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-x-circle-fill text-danger me-2"></i>
                    Aprobación administrativa
                </div>
                <span class="badge bg-danger rounded-pill">No iniciado</span>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5>Acciones Rápidas</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="#" class="card text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-plus fs-1 text-primary mb-2"></i>
                        <h5>Subir Documentos</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="card text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card fs-1 text-success mb-2"></i>
                        <h5>Pagar Matrícula</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="card text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-dots fs-1 text-info mb-2"></i>
                        <h5>Solicitar Ayuda</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 
@extends('admin.layout')

@section('title', 'Gestión de Usuarios')

@section('content')
<!-- Encabezado y estadísticas -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="d-flex align-items-center">
            <div class="bg-primary rounded-circle p-2 me-3">
                <i class="bi bi-people-fill text-white fs-7"></i>
            </div>
            <div>
                <h2 class="mb-1">Gestión de Usuarios</h2>
                <p class="text-muted mb-0">Administra los usuarios del sistema</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
        </a>
    </div>
</div>

<!-- Tarjetas de estadísticas -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-people-fill text-white fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Usuarios</h6>
                    <h3 class="mb-0">{{ $users->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                    <i class="bi bi-shield-lock text-danger fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Administradores</h6>
                    <h3 class="mb-0">{{ $users->where('role', 'super_admin')->count() + $users->where('role', 'admin')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-person text-success fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Usuarios Regulares</h6>
                    <h3 class="mb-0">{{ $users->where('role', 'user')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                    <i class="bi bi-calendar-check text-warning fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Nuevos (30 días)</h6>
                    <h3 class="mb-0">{{ $users->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alertas -->
@if(session('success'))
    <div class="alert alert-success d-flex align-items-center border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger d-flex align-items-center border-0 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Filtros y búsqueda -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar por nombre o email" name="search" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="role">
                    <option value="">Todos los roles</option>
                    <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Administrador</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="order">
                    <option value="newest" {{ request('order') == 'newest' ? 'selected' : '' }}>Más recientes</option>
                    <option value="oldest" {{ request('order') == 'oldest' ? 'selected' : '' }}>Más antiguos</option>
                    <option value="name_asc" {{ request('order') == 'name_asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                    <option value="name_desc" {{ request('order') == 'name_desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                </select>
            </div>
            <div class="col-md-2 d-flex">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-filter me-1"></i> Filtrar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de usuarios -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha Creación</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4">{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">{{ substr($user->name, 0, 1) }}</div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'super_admin')
                                    <span class="badge bg-primary-custom">Super Administrador</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge bg-secondary-custom">Administrador</span>
                                @else
                                    <span class="badge bg-light-custom">Usuario</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Editar usuario">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(Auth::user()->role === 'super_admin' && Auth::id() != $user->id && $user->role !== 'super_admin')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Eliminar usuario" onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-people text-muted d-block mb-3" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0">No hay usuarios que coincidan con los criterios de búsqueda</p>
                                @if(request('search') || request('role') || request('order'))
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary mt-3">
                                        <i class="bi bi-arrow-repeat me-1"></i> Restablecer filtros
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Paginación -->
@if(method_exists($users, 'links'))
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>
@endif

<style>
    /* Estilos personalizados */
    .bg-primary {
        background-color: #09307b !important;
    }
    
    .text-primary {
        color: #09307b !important;
    }
    
    .btn-primary {
        background-color: #09307b;
        border-color: #09307b;
    }
    
    .btn-primary:hover {
        background-color: #072661;
        border-color: #072661;
    }
    
    .btn-outline-primary {
        color: #09307b;
        border-color: #09307b;
    }
    
    .btn-outline-primary:hover {
        background-color: #09307b;
        border-color: #09307b;
    }
    
    .avatar-circle {
        width: 32px;
        height: 32px;
        background-color: #09307b;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
        border-radius: 50rem;
    }
    
    .bg-primary-custom {
        background-color: #09307b;
        color: white;
    }
    
    .bg-secondary-custom {
        background-color: #ffcc00;
        color: #333;
    }
    
    .bg-light-custom {
        background-color: #e9ecef;
        color: #333;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
    }
    
    .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    
    .table tbody tr:hover {
        background-color: rgba(9, 48, 123, 0.03);
    }
    
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .alert {
        border-radius: 0.5rem;
        padding: 1rem;
    }
    
    .input-group-text {
        background-color: transparent;
    }
    
    /* Estilos para la paginación */
    .pagination {
        --bs-pagination-active-bg: #09307b;
        --bs-pagination-active-border-color: #09307b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips de Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Auto-cerrar alertas después de 5 segundos
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema de Matrículas INEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }
        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, 1);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: #4a76a8;
        }
        .main-content {
            padding: 20px;
        }
        .stats-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stats-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stats-icon {
            background-color: #4a76a8;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h3 class="text-center mb-4">INEM Admin</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    @if(Auth::user()->role === 'super_admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i> Usuarios
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_roles'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                            <i class="bi bi-person-badge me-2"></i> Roles
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_permissions'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                            <i class="bi bi-key me-2"></i> Permisos
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_enrollment'))
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-book me-2"></i> Matrículas
                        </a>
                    </li>
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear me-2"></i> Configuración
                        </a>
                    </li>
                    
                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">
                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>@yield('title', 'Panel de Administración')</h2>
                    <div>
                        <span class="me-2">Bienvenido, {{ Auth::user()->name }}</span>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
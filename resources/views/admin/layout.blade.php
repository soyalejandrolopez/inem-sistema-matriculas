<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema de Matrículas INEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #09307b;
            --secondary-color: #ffcc00;
            --primary-light: #1a4494;
            --primary-dark: #072661;
            --secondary-light: #ffda47;
            --secondary-dark: #e6b800;
            --text-light: #ffffff;
            --text-dark: #333333;
            --border-color: rgba(9, 48, 123, 0.2);
            --hover-bg: rgba(9, 48, 123, 0.05);
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background-color: var(--primary-color);
            padding-top: 20px;
            color: var(--text-light);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            margin: 5px 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: var(--text-light);
            background-color: var(--primary-light);
        }

        .sidebar .nav-link.active {
            color: var(--text-dark);
            background-color: var(--secondary-color);
            font-weight: 500;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--primary-light);
        }

        .sidebar-brand-icon {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Main Content Styles */
        .main-content {
            padding: 25px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .welcome-badge {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .welcome-badge .user-avatar {
            background-color: var(--primary-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 500;
        }

        /* Stats Cards */
        .stats-card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
        }

        .stats-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        .stats-card .stats-info h5 {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .stats-card .stats-info h2 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            color: var(--text-dark);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stats-icon.students {
            background-color: rgba(9, 48, 123, 0.1);
            color: var(--primary-color);
        }

        .stats-icon.enrollments {
            background-color: rgba(255, 204, 0, 0.2);
            color: #e6b800;
        }

        .stats-icon.pending {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        /* Tables */
        .table-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .table-card .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-dark);
        }

        .table-card .table {
            margin-bottom: 0;
        }

        .table-card .table th {
            font-weight: 500;
            color: #6c757d;
            border-bottom-width: 1px;
            padding: 12px 20px;
        }

        .table-card .table td {
            padding: 12px 20px;
            vertical-align: middle;
        }

        .table-card .table tr:hover {
            background-color: var(--hover-bg);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--text-dark);
        }

        .btn-warning:hover {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
            color: var(--text-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 250px;
                z-index: 1000;
                transition: all 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .sidebar-toggle {
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 999;
                background-color: var(--primary-color);
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .main-content {
                margin-left: 0;
                padding-top: 70px;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .welcome-badge {
                margin-top: 15px;
            }
        }

        @media (min-width: 769px) {
            .sidebar-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle d-md-none" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <div class="sidebar-brand">
                    <div class="sidebar-brand-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3 class="m-0">INEM Admin</h3>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    
                    @if(Auth::user()->role === 'super_admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i> Usuarios
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_roles'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                            <i class="bi bi-person-badge"></i> Roles
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_permissions'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                            <i class="bi bi-key"></i> Permisos
                        </a>
                    </li>
                    @endif
                    
                    @if(Auth::user()->role === 'super_admin' || Auth::user()->hasPermission('manage_enrollment'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/enrollments*') ? 'active' : '' }}" href="#">
                            <i class="bi bi-book"></i> Matrículas
                        </a>
                    </li>
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#">
                            <i class="bi bi-gear"></i> Configuración
                        </a>
                    </li>
                    
                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="page-header">
                    <div>
                        <h2 class="mb-1">@yield('title', 'Panel de Administración')</h2>
                        <p class="text-muted mb-0">Sistema de Matrículas INEM</p>
                    </div>
                    <div class="welcome-badge">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span>Bienvenido, {{ Auth::user()->name }}</span>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
                
                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggle = sidebarToggle.contains(event.target);
                    
                    if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>
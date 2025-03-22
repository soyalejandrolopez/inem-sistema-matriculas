<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación - Sistema Integrado de Matrículas</title>
    <!-- Cargar SweetAlert2 ANTES de Bootstrap para evitar conflictos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #09307b;       /* Azul oscuro */
            --primary-hover: #072258;       /* Azul más oscuro para hover */
            --secondary-color: #ffcc00;     /* Amarillo dorado */
            --secondary-hover: #e6b800;     /* Amarillo dorado más oscuro para hover */
            --background-color:rgb(255, 255, 255);
            --text-on-primary: #ffffff;
            --text-on-secondary: #09307b;
        }
        
        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            max-width: 400px;
            margin: 80px auto;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            text-align: center;
            font-weight: bold;
            padding: 20px;
            border-bottom: none;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(9, 48, 123, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--text-on-primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(9, 48, 123, 0.3);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--text-on-secondary);
            font-weight: 600;
        }
        
        .btn-secondary:hover {
            background-color: var(--secondary-hover);
            border-color: var(--secondary-hover);
            color: var(--text-on-secondary);
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        
        .form-check-label {
            color: #6c757d;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        
        .input-group-text {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            border: none;
            cursor: pointer;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .text-secondary {
            color: var(--secondary-color) !important;
        }
        
        .inem-highlight {
            color: var(--secondary-color);
            font-weight: bold;
        }
        
        .forgot-password {
            color: var(--primary-color);
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--primary-hover);
            text-decoration: underline !important;
        }
        
        /* Estilo para el borde inferior amarillo */
        .card-header::after {
            content: '';
            display: block;
            height: 4px;
            background-color: var(--secondary-color);
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container animate__animated animate__fadeIn">
            <div class="logo-container">
                <img src="{{ asset('images/inem.jpg') }}" alt="Logo INEM" class="logo">
            </div>
            
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <h3 class="mb-0">Sistema Integrado de Matrículas</h3>
                </div>
                <div class="card-body">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="tucorreo@inem.edu.co">
                            </div>
                            @error('email')
                                <span class="text-danger mt-1 d-block">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Ingrese su contraseña">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger mt-1 d-block">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" 
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Ingresar
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <a href="#" id="forgotPassword" class="text-decoration-none forgot-password">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Verificar que SweetAlert2 esté disponible
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 no está cargado correctamente');
            // Intentar cargar SweetAlert2 nuevamente
            var script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            document.head.appendChild(script);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Configuración personalizada para SweetAlert basada en los colores INEM
            const SwalINEM = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });
            
            // Verificar si hay mensajes de error específicos en la sesión
            @if(session('error'))
                const errorMessage = "{{ session('error') }}";
                
                if (errorMessage.includes('usuario no existe') || errorMessage.includes('no encontrado')) {
                    SwalINEM.fire({
                        title: 'Usuario no encontrado',
                        text: 'El correo electrónico ingresado no está registrado en nuestro sistema.',
                        icon: 'error',
                        confirmButtonText: 'Intentar de nuevo'
                    });
                } else if (errorMessage.includes('contraseña incorrecta') || errorMessage.includes('credenciales')) {
                    SwalINEM.fire({
                        title: 'Contraseña incorrecta',
                        text: 'La contraseña ingresada no es correcta. Por favor, inténtalo nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'Intentar de nuevo'
                    });
                } else {
                    SwalINEM.fire({
                        title: '¡Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Intentar de nuevo'
                    });
                }
            @endif
            
            // Verificar si hay mensajes de éxito en la sesión
            @if(session('success'))
                SwalINEM.fire({
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Continuar'
                });
            @endif
            
            // Validación del formulario
            const loginForm = document.getElementById('loginForm');
            
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    
                    if (!email) {
                        SwalINEM.fire({
                            title: 'Campo requerido',
                            text: 'Por favor ingresa tu correo electrónico',
                            icon: 'warning',
                            confirmButtonText: 'Entendido'
                        });
                        return;
                    }
                    
                    if (!password) {
                        SwalINEM.fire({
                            title: 'Campo requerido',
                            text: 'Por favor ingresa tu contraseña',
                            icon: 'warning',
                            confirmButtonText: 'Entendido'
                        });
                        return;
                    }
                    
                    // Validar formato de correo electrónico
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        SwalINEM.fire({
                            title: 'Formato inválido',
                            text: 'Por favor ingresa un correo electrónico válido',
                            icon: 'warning',
                            confirmButtonText: 'Entendido'
                        });
                        return;
                    }
                    
                    // Mostrar animación de carga
                    SwalINEM.fire({
                        title: 'Iniciando sesión',
                        text: 'Por favor espere...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Simulación de validación de usuario (esto sería reemplazado por la validación real del servidor)
                    // En un entorno real, esto se manejaría en el backend y no aquí
                    setTimeout(() => {
                        // Aquí solo estamos simulando para demostración
                        // En la implementación real, simplemente enviarías el formulario y el servidor manejaría la validación
                        
                        // Para propósitos de demostración, vamos a simular algunos casos de error
                        // Descomentar para probar diferentes escenarios:
                        
                        /*
                        // Simular usuario no encontrado
                        if (email !== 'admin@inem.edu.co') {
                            SwalINEM.fire({
                                title: 'Usuario no encontrado',
                                text: 'El correo electrónico ingresado no está registrado en nuestro sistema.',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo'
                            });
                            return;
                        }
                        
                        // Simular contraseña incorrecta
                        if (password !== 'admin123') {
                            SwalINEM.fire({
                                title: 'Contraseña incorrecta',
                                text: 'La contraseña ingresada no es correcta. Por favor, inténtalo nuevamente.',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo'
                            });
                            return;
                        }
                        */
                        
                        // Enviar el formulario para procesamiento en el servidor
                        this.submit();
                    }, 1500);
                });
            }
            
            // Mostrar/ocultar contraseña
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Cambiar el icono
                    if (type === 'text') {
                        toggleIcon.classList.remove('bi-eye-slash-fill');
                        toggleIcon.classList.add('bi-eye-fill');
                    } else {
                        toggleIcon.classList.remove('bi-eye-fill');
                        toggleIcon.classList.add('bi-eye-slash-fill');
                    }
                });
            }

            // Manejo de "Olvidaste tu contraseña"
            const forgotPassword = document.getElementById('forgotPassword');
            if (forgotPassword) {
                forgotPassword.addEventListener('click', function(e) {
                    e.preventDefault();
                    SwalINEM.fire({
                        title: 'Recuperar contraseña',
                        text: 'Contacta al administrador del sistema para restablecer tu contraseña',
                        icon: 'info',
                        confirmButtonText: 'Entendido'
                    });
                });
            }
        });
    </script>
    <footer class="text-center py-4">
        <p class="text-muted">Sistema Integrado de Matrículas &copy; {{ date('Y') }} INEM Francisco José de Caldas Popayán</p>
    </footer>
</body>
</html>


@extends('admin.layout')

@section('title', 'Editar Usuario')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white d-flex align-items-center border-bottom">
        <i class="bi bi-person-gear me-2 text-primary"></i>
        <h5 class="mb-0">Editar Usuario: <span class="text-primary">{{ $user->name }}</span></h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Información básica -->
                <div class="col-md-6">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3 text-primary">
                                <i class="bi bi-info-circle me-2"></i>Información Básica
                            </h6>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Nombre <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Nombre completo">
                                </div>
                                @error('name')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="correo@ejemplo.com">
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <h6 class="card-title mb-3 text-primary">
                                <i class="bi bi-shield-lock me-2"></i>Cambiar Contraseña
                            </h6>
                            
                            <div class="alert alert-info d-flex align-items-center small mb-3">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <div>Deje estos campos en blanco si no desea cambiar la contraseña actual.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-key"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                                <div class="form-text">La contraseña debe tener al menos 8 caracteres.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-medium">Confirmar Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-key-fill"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Roles y permisos -->
                <div class="col-md-6">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-3 text-primary">
                                <i class="bi bi-person-badge me-2"></i>Roles y Permisos
                            </h6>
                            
                            <div class="mb-4">
                                <label for="role" class="form-label fw-medium">Rol principal <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="super_admin" {{ (old('role', $user->role) == 'super_admin') ? 'selected' : '' }}>Super Administrador</option>
                                    <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Administrador</option>
                                    <option value="user" {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>Usuario</option>
                                </select>
                                @error('role')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium">Roles adicionales</label>
                                <div class="card border">
                                    <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                                        @forelse($roles as $role)
                                            <div class="form-check custom-checkbox mb-2">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" 
                                                    {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) || 
                                                       (old('roles') === null && in_array($role->id, $userRoles)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    <span class="fw-medium">{{ $role->display_name ?? $role->name }}</span>
                                                    @if($role->description)
                                                        <small class="text-muted d-block">{{ $role->description }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        @empty
                                            <div class="text-center py-3">
                                                <i class="bi bi-exclamation-circle text-muted d-block mb-2" style="font-size: 1.5rem;"></i>
                                                <p class="text-muted mb-0">No hay roles adicionales disponibles.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
                <div>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-eye me-1"></i> Ver Detalles
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Actualizar Usuario
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Estilos personalizados para el formulario */
    .form-label {
        color: #555;
    }
    
    .input-group-text {
        border-right: 0;
    }
    
    .input-group .form-control {
        border-left: 0;
    }
    
    .input-group .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    
    .input-group .form-control:focus + .input-group-text {
        border-color: #ced4da;
    }
    
    .form-select, .form-control {
        padding: 0.6rem 0.75rem;
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
        color: white;
    }
    
    .text-primary {
        color: #09307b !important;
    }
    
    .form-check-input:checked {
        background-color: #09307b;
        border-color: #09307b;
    }
    
    .card-title {
        font-weight: 600;
    }
    
    .custom-checkbox .form-check-input {
        width: 1.1em;
        height: 1.1em;
    }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-top-left-radius: 0.5rem !important;
        border-top-right-radius: 0.5rem !important;
    }
    
    .alert-info {
        background-color: rgba(9, 48, 123, 0.1);
        border-color: rgba(9, 48, 123, 0.2);
        color: #09307b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
        
        // Toggle confirm password visibility
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('password_confirmation');
        
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TipoDocumentoController;
use App\Http\Controllers\Admin\GeneroController;
use App\Http\Controllers\Admin\TipoSangreController;
use App\Http\Controllers\Admin\EpsController;
use App\Http\Controllers\Admin\GrupoEtnicoController;
use App\Http\Controllers\Admin\SedeEducativaController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\EstudianteController;
use App\Http\Controllers\Admin\AcudienteController;
use App\Http\Controllers\Admin\PadreController;
use App\Http\Controllers\Admin\MadreController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin Routes - Rutas para usuarios y roles
Route::prefix('admin')->group(function () {
    // Eliminamos esta ruta conflictiva y usamos AdminDashboardController en su lugar
    // Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class, ['as' => 'admin']);
    Route::resource('permissions', PermissionController::class, ['as' => 'admin']);
    Route::resource('users', UserController::class, ['as' => 'admin']);
});

// Grupo de rutas para el área administrativa
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard - Ahora solo usamos esta ruta para el dashboard administrativo
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // Ruta alternativa
    
    // Rutas para gestionar los tipos de documento
    Route::resource('tipo-documentos', TipoDocumentoController::class);
    
    // Rutas para gestionar los géneros
    Route::resource('generos', GeneroController::class);
    
    // Rutas para gestionar los tipos de sangre
    Route::resource('tipo-sangres', TipoSangreController::class);
    
    // Rutas para gestionar las EPS
    Route::resource('eps', EpsController::class);
    
    // Rutas para gestionar los grupos étnicos
    Route::resource('grupo-etnicos', GrupoEtnicoController::class);
    
    // Rutas para gestionar las sedes educativas
    Route::resource('sede-educativas', SedeEducativaController::class);
    
    // Rutas para gestionar los grados
    Route::resource('grados', GradoController::class);
    
    // Rutas para gestionar los estudiantes
    Route::resource('estudiantes', EstudianteController::class);
    
    // Rutas para gestionar los acudientes
    Route::resource('acudientes', AcudienteController::class);
    
    // Rutas para gestionar los padres
    Route::resource('padres', PadreController::class);
    
    // Rutas para gestionar las madres
    Route::resource('madres', MadreController::class);
}); 
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Admin\MedicamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 🔹 Dashboard de Paciente
Route::get('/paciente/dashboard', function () {
    return view('paciente.dashboard');
})->middleware(['auth', 'verified'])->name('paciente.dashboard');

// 🔹 Dashboard de Doctor
Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
})->middleware(['auth', 'verified'])->name('doctor.dashboard');

// 🔹 Dashboard de Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔹 Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para el controlador del Doctor
Route::middleware(['auth', 'verified'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('dashboard');
    Route::get('/pacientes', [DoctorController::class, 'mostrarPacientes'])->name('pacientes');
    Route::get('/citas', [DoctorController::class, 'citas'])->name('citas');
    Route::get('/historial', [DoctorController::class, 'historial'])->name('historial');
    Route::get('/estudios', [DoctorController::class, 'estudios'])->name('estudios');
    Route::get('/mensajes', [DoctorController::class, 'mensajes'])->name('mensajes');
});

// Rutas para el controlador del Administrador
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes'); 
    
    Route::get('/backup', [AdminController::class, 'backup'])->name('backup');
    
    // Rutas para la gestión de usuarios
    Route::get('usuarios/pacientes', [UserController::class, 'mostrarPacientes'])->name('usuarios.pacientes');
    Route::get('usuarios/doctores', [UserController::class, 'mostrarDoctores'])->name('usuarios.doctores');
    Route::resource('usuarios', UserController::class)->parameters([
        'usuarios' => 'user'
    ]);

    // Rutas para el CRUD de Medicamentos 
    Route::resource('medicamentos', MedicamentoController::class)->parameters([
        'medicamentos' => 'medicamento'
    ]);

    Route::get('/backup', [AdminController::class, 'backup'])->name('backup.index');
    Route::post('/backup/create', [AdminController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [AdminController::class, 'restoreBackup'])->name('backup.restore');
    Route::post('/backup/delete', [AdminController::class, 'deleteBackup'])->name('backup.delete');
});

Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');

require __DIR__.'/auth.php';
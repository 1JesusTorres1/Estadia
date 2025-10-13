<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\Admin\MedicamentoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas y de Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Ruta de Redirección Post-Login
|--------------------------------------------------------------------------
|
| Esta ruta redirige a los usuarios a su dashboard correcto después de iniciar sesión.
|
*/
Route::get('/dashboard', function () {
    if (auth()->check()) {
        $rol = auth()->user()->rol;
        if ($rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($rol === 'doctor') {
            return redirect()->route('doctor.dashboard');
        }
    }
    // Por defecto, o si es paciente, va al dashboard de paciente.
    return redirect()->route('paciente.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Rol
|--------------------------------------------------------------------------
*/

// --- RUTAS SOLO PARA PACIENTES ---
Route::middleware(['auth', 'verified', 'role:paciente'])->prefix('paciente')->name('paciente.')->group(function () {
    Route::get('/dashboard', function () { return view('paciente.dashboard'); })->name('dashboard');
    Route::get('/historialMedico', [PacienteController::class, 'miHistorial'])->name('historialMedico');
    Route::get('/mediciones', [PacienteController::class, 'misMediciones'])->name('mediciones');
    Route::get('/prescripciones', [PacienteController::class, 'misPrescripciones'])->name('prescripciones');
});

// --- RUTAS PARA DOCTORES (Y TAMBIÉN ACCESIBLES POR ADMINS) ---
Route::middleware(['auth', 'verified', 'role:doctor,admin'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('dashboard');
    Route::get('/pacientes', [DoctorController::class, 'mostrarPacientes'])->name('pacientes');
    Route::get('/citas', [DoctorController::class, 'citas'])->name('citas');
    Route::get('/historial', [DoctorController::class, 'historial'])->name('historial');
    Route::get('/estudios', [DoctorController::class, 'estudios'])->name('estudios');
    Route::get('/mensajes', [DoctorController::class, 'mensajes'])->name('mensajes');

    // Gestión de un paciente específico (usa el controlador central)
    Route::get('/pacientes/{user}', [PacienteController::class, 'show'])->name('pacientes.historialMedico');
    Route::patch('/pacientes/{user}/historial', [PacienteController::class, 'updateHistorial'])->name('pacientes.historial.update');
    Route::post('/pacientes/{user}/historial', [PacienteController::class, 'createHistorial'])->name('pacientes.historial.create');

    // Rutas para ver y agregar mediciones de un paciente
    Route::get('/pacientes/{user}/mediciones', [PacienteController::class, 'verMediciones'])->name('pacientes.mediciones');
    Route::post('/pacientes/{user}/mediciones', [PacienteController::class, 'CreateMedicion'])->name('pacientes.mediciones.agregar');

    // Rutas para ver y agregar prescripciones medicas
    Route::get('/pacientes/{user}/prescripcion', [PacienteController::class, 'verPrescripciones'])->name('pacientes.prescripcion.ver');

    // RUTA POST para procesar el formulario
    Route::post('/pacientes/{user}/prescripcion', [PacienteController::class, 'CreatePrescripcion'])->name('pacientes.prescripcion.agregar');
});

// --- RUTAS EXCLUSIVAS PARA ADMINS ---
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes'); 
    
    // Rutas para la gestión de usuarios
    Route::get('usuarios/pacientes', [UserController::class, 'mostrarPacientes'])->name('usuarios.pacientes');
    Route::get('usuarios/doctores', [UserController::class, 'mostrarDoctores'])->name('usuarios.doctores');
    
    // CRUD de usuarios
    Route::resource('usuarios', UserController::class)->parameters([
        'usuarios' => 'user' 
    ]);

    // Rutas de Pacientes para Admin (siguen usando el PacienteController)
    Route::get('/pacientes/{user}', [PacienteController::class, 'show'])->name('pacientes.show');
    Route::patch('/pacientes/{user}/historial', [PacienteController::class, 'updateHistorial'])->name('pacientes.historial.update');
    Route::post('/pacientes/{user}/historial', [PacienteController::class, 'createHistorial'])->name('pacientes.historial.create');

    // CRUD de Medicamentos 
    Route::resource('medicamentos', MedicamentoController::class);

    // Rutas de Backup
    Route::get('/backup', [AdminController::class, 'backup'])->name('backup.index');
    Route::post('/backup/create', [AdminController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [AdminController::class, 'restoreBackup'])->name('backup.restore');
    Route::post('/backup/delete', [AdminController::class, 'deleteBackup'])->name('backup.delete');
});


// --- RUTAS DE PERFIL (ACCESIBLES POR TODOS LOS USUARIOS LOGUEADOS) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


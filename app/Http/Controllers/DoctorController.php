<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    /**
     * Muestra el dashboard del doctor.
     */
    public function index()
    {
        return view('doctor.dashboard');
    }

    /**
     * Lista de pacientes del doctor.
     */
    public function mostrarPacientes()
    {
        $users = User::where('rol', 'paciente')->with('paciente')->paginate(10);
        return view('doctor.pacientes', compact('users'));
    }

    /**
     * Citas médicas.
     */
    public function citas()
    {
        return view('doctor.citas');
    }

    /**
     * Historial médico de pacientes.
     */
    public function historial()
    {
        return view('doctor.historial');
    }

    /**
     * Estudios y reportes médicos.
     */
    public function estudios()
    {
        return view('doctor.estudios');
    }

    /**
     * Mensajes o notificaciones.
     */
    public function mensajes()
    {
        return view('doctor.mensajes');
    }
}

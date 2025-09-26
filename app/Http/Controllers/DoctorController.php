<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function pacientes()
    {
        return view('doctor.pacientes');
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

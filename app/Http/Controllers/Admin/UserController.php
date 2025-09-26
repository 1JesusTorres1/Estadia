<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos básicos
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|max:14',
            'rol' => 'required|string' 
        ]);

        // Validar campos según su rol
        if ($request->rol === 'paciente') {
            $request->validate([
                'tipoDiabetes' => 'required|string|max:255',
                'sexo' => 'required|string',
                'fecha_nacimiento' => 'required|date',
            ]);
        } elseif ($request->rol === 'doctor') {
            $request->validate([
                'especialidad' => 'required|string|max:255',
                'cedula' => 'required|string|max:255',
            ]);
        }

        // Crear el usuario 
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol, // Asignar el rol del request
        ]);

        // Crear el perfil asociado (paciente o doctor)
        if ($request->rol === 'paciente') {
            $user->paciente()->create([
                'fechaRegistro' => now(),
                'tipoDiabetes' => $request->tipoDiabetes,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
            ]);
        } elseif ($request->rol === 'doctor') {
            $user->doctor()->create([
                'especialidad' => $request->especialidad,
                'cedula' => $request->cedula,
            ]);
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $viejoRol = $user->rol;

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|string'
        ]);

        if ($request->rol === 'paciente') {
            $request->validate([
                'tipoDiabetes' => 'required|string|max:255',
                'sexo' => 'required|string|in:Masculino,Femenino,Otro',
                'fecha_nacimiento' => 'required|date',
            ]);
        } elseif ($request->rol === 'doctor') {
            $request->validate([
                'especialidad' => 'required|string|max:255',
                'cedula' => 'required|string|max:255',
            ]);
        }        

        $user->update([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'rol' => $request->rol,
        ]);

         if ($viejoRol !== $request->rol) {
            if ($viejoRol === 'paciente' && $user->paciente) {
                $user->paciente->delete();
            } elseif ($viejoRol === 'doctor' && $user->doctor) {
                $user->doctor->delete();
            }
        }
        
        if ($request->rol === 'paciente') {
            if ($user->paciente) {
                $user->paciente->update([
                    'tipoDiabetes' => $request->tipoDiabetes,
                    'sexo' => $request->sexo,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                ]);
            } else {
                $user->paciente()->create([
                    'fechaRegistro' => now(),
                    'tipoDiabetes' => $request->tipoDiabetes,
                    'sexo' => $request->sexo,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                ]);
            }
        } elseif ($request->rol === 'doctor') {
            if ($user->doctor) {
                $user->doctor->update([
                    'especialidad' => $request->especialidad,
                    'cedula' => $request->cedula,
                ]);
            } else {
                $user->doctor()->create([
                    'especialidad' => $request->especialidad,
                    'cedula' => $request->cedula,
                ]);
            }
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Muestra una lista de usuarios con el rol 'paciente'.
     */
    public function mostrarPacientes()
    {
        // Carga los usuarios y sus datos de paciente en una sola consulta
        $users = User::where('rol', 'paciente')->with('paciente')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Muestra una lista de usuarios con el rol 'doctor'.
     */
    public function mostrarDoctores()
    {
        // Carga los usuarios y sus datos de doctor en una sola consulta
        $users = User::where('rol', 'doctor')->with('doctor')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Muestra una lista de usuarios con el rol 'admin'.
     */
    public function mostrarAdmin()
    {
        $users = User::where('rol', 'admin')->paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }
}

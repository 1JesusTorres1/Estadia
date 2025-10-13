<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'sexo' => 'required|string',
            'tipoDiabetes' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'paciente',
        ]);

        // Crear el perfil de paciente asociado al usuario
        $paciente = $user->paciente()->create([
            'fechaRegistro' => now(),
            'tipoDiabetes' => $request->tipoDiabetes,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        // Crear historial médico vacío para el paciente
        $paciente->historialMedico()->create(); 

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('paciente.dashboard', absolute: false));
    }
}

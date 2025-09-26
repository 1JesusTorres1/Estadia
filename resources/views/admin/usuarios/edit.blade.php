<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>
    |
    <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
        ⬅️ Volver
    </button>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            
            <div class="w-full md:w-3/4 lg:w-1/2 xl:w-1/4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div>
                            <label for="apellido" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('apellido', $user->apellido) }}" required>
                        </div>
                        <div>
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div>
                            <label for="rol" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Rol</label>
                            <select name="rol" id="rol" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="paciente" {{ $user->rol == 'paciente' ? 'selected' : '' }}>Paciente</option>
                                <option value="doctor" {{ $user->rol == 'doctor' ? 'selected' : '' }}>Doctor</option>
                                <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div id="camposDoctor" class="mt-6 {{ $user->rol == 'doctor' ? '' : 'hidden' }}">
                        <div class="space-y-6">
                            <div>
                                <label for="especialidad" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Especialidad</label>
                                <input type="text" name="especialidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('especialidad', optional($user->doctor)->especialidad) }}">
                            </div>
                            <div>
                                <label for="cedula" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cédula</label>
                                <input type="text" name="cedula" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('cedula', optional($user->doctor)->cedula) }}">
                            </div>
                        </div>
                    </div>

                    <div id="camposPaciente" class="mt-6 {{ $user->rol == 'paciente' ? '' : 'hidden' }}">
                        <div class="space-y-6">
                            <div>
                                <label for="fechaRegistro" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fecha de Registro</label>
                                <input type="date" id="fechaRegistro" name="fechaRegistro" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('fechaRegistro', optional($user->paciente)->fechaRegistro ? $user->paciente->fechaRegistro->format('Y-m-d') : '') }}">
                            </div>
                            <div>
                                <label for="tipoDiabetes" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Diabetes</label>
                                <input type="text" name="tipoDiabetes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('tipoDiabetes', optional($user->paciente)->tipoDiabetes) }}">
                            </div>
                            <div>
                                <label for="sexo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Sexo</label>
                                <select name="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled {{ !old('sexo', optional($user->paciente)->sexo) ? 'selected' : '' }}>Seleccione un sexo</option>
                                    <option value="Masculino" {{ old('sexo', optional($user->paciente)->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo', optional($user->paciente)->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('sexo', optional($user->paciente)->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                            <div>
                                <label for="fecha_nacimiento" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fecha de Nacimiento</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('fecha_nacimiento', optional($user->paciente)->fecha_nacimiento ? $user->paciente->fecha_nacimiento->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rolSelect = document.getElementById('rol');
        const camposDoctor = document.getElementById('camposDoctor');
        const camposPaciente = document.getElementById('camposPaciente');

        function toggleCampos() {
            const selectedRol = rolSelect.value;
            camposDoctor.classList.add('hidden');
            camposPaciente.classList.add('hidden');

            if (selectedRol === 'doctor') {
                camposDoctor.classList.remove('hidden');
            } else if (selectedRol === 'paciente') {
                camposPaciente.classList.remove('hidden');
            }
        }

        rolSelect.addEventListener('change', toggleCampos);

        toggleCampos();
    });
</script>
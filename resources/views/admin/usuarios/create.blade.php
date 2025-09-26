<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>
    
    <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
        ⬅️ Volver
    </button>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                

                <form method="POST" action="{{ route('admin.usuarios.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="apellido" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Contraseña</label>
                            <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="rol" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Rol</label>
                            <select name="rol" id="rol" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" disabled selected hidden>Seleccione un rol</option>
                                <option value="paciente">Paciente</option>
                                <option value="doctor">Doctor</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                        <div id="camposDoctor" class="hidden space-y-4">
                            <div>
                                <label for="especialidad" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Especialidad</label>
                                <input type="text" name="especialidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="cedula" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cédula</label>
                                <input type="text" name="cedula" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div id="camposPaciente" class="hidden space-y-4">
                            <div>
                                <label for="tipoDiabetes" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Diabetes</label>
                                <input type="text" name="tipoDiabetes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="sexo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Sexo</label>
                                <select name="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled selected hidden>Seleccione un sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div>
                                <label for="fecha_nacimiento" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Crear
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('rol').addEventListener('change', function () {
        let rol = this.value;
        const camposDoctor = document.getElementById('camposDoctor');
        const camposPaciente = document.getElementById('camposPaciente');

        // Ocultar ambos campos al principio
        camposDoctor.classList.add('hidden');
        camposPaciente.classList.add('hidden');

        // Mostrar solo los campos del rol seleccionado
        if (rol === 'doctor') {
            camposDoctor.classList.remove('hidden');
        } else if (rol === 'paciente') {
            camposPaciente.classList.remove('hidden');
        }
    });
</script>
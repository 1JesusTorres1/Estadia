<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalles del Paciente: <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }} {{ $user->apellido }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'historial-actualizado' || session('status') === 'historial-creado')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative dark:bg-emerald-900 dark:border-emerald-600 dark:text-emerald-300" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    @if (session('status') === 'historial-actualizado')
                        <span class="block sm:inline">Historial médico actualizado correctamente.</span>
                    @else
                        <span class="block sm:inline">Historial médico creado. Ya puede editarlo.</span>
                    @endif
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Columna de Información del Paciente -->
                <div class="lg-col-span-1 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 self-start">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                        Información Personal
                    </h3>
                    <div class="space-y-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }} {{ $user->apellido }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Correo Electrónico</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->email }}</p>
                        </div>
                        @if($user->paciente)
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sexo</p>
                                <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->paciente->sexo }}</p>
                            </div>
                             <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</p>
                                <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->paciente->fecha_nacimiento ? \Carbon\Carbon::parse($user->paciente->fecha_nacimiento)->format('d/m/Y') : 'No especificada' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Diabetes</p>
                                <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->paciente->tipoDiabetes }}</p>
                            </div>
                        @endif
                    </div>
                </div><br>

                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                        Medicamentos recetados
                    </h3>
                    @php
                        $prescripciones = optional($user->paciente)->prescripciones ?? collect();
                    @endphp

                    @if($prescripciones->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha de inicio</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha de termino</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Medicamento</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dosis</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Indicaciones</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Doctor</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($prescripciones->sortByDesc('fecha_prescripcion') as $prescripcion)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->fecha_prescripcion->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->fecha_fin_consumo->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->medicamento->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->dosis }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->indicaciones ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">{{ $prescripcion->doctor->name ?? 'Sistema' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Este paciente aún no tiene prescripciones registradas.</p>
                    @endif
                </div>
                </div>
        
                <!-- Columna del Historial Médico -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                        Historial Médico
                    </h3>
                    
                    @if($user->paciente && $user->paciente->historialMedico)
                        @php
                            $routeNamePrefix = $routeNamePrefix ?? (Auth::user()->rol === 'admin' ? 'admin.' : 'doctor.');
                        @endphp

                        <form method="post" action="{{ route($routeNamePrefix . 'pacientes.historial.update', $user) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="antecedentesFamiliares" :value="__('Antecedentes Familiares')" />
                                <textarea id="antecedentesFamiliares" name="antecedentesFamiliares" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('antecedentesFamiliares', $user->paciente->historialMedico->antecedentesFamiliares) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('antecedentesFamiliares')" />
                            </div>

                            <div>
                                <x-input-label for="alergias" :value="__('Alergias Conocidas')" />
                                <textarea id="alergias" name="alergias" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('alergias', $user->paciente->historialMedico->alergias) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alergias')" />
                            </div>

                            <div>
                                <x-input-label for="enfermedades" :value="__('Otras Enfermedades Relevantes')" />
                                <textarea id="enfermedades" name="enfermedades" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('enfermedades', $user->paciente->historialMedico->enfermedades) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('enfermedades')" />
                            </div>

                            <div>
                                <x-input-label for="notasMedicas" :value="__('Notas Médicas Adicionales')" />
                                <textarea id="notasMedicas" name="notasMedicas" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('notasMedicas', $user->paciente->historialMedico->notasMedicas) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('notasMedicas')" />
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>
                            </div>
                        </form>
                    @else
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                            <p class="mb-4">Este paciente no tiene un historial médico asociado todavía.</p>
                            
                            @php
                                // Asegurarse de que el prefijo de la ruta está definido
                                $routeNamePrefix = $routeNamePrefix ?? (Auth::user()->rol === 'admin' ? 'admin.' : 'doctor.');
                            @endphp

                            <form method="post" action="{{ route($routeNamePrefix . 'pacientes.historial.create', $user) }}">
                                @csrf
                                <x-primary-button>
                                    {{ __('Crear Historial Médico') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


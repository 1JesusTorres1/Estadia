<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Mediciones del Paciente: <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }} {{ $user->apellido }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'medicion-agregada')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative dark:bg-emerald-900 dark:border-emerald-600 dark:text-emerald-300" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">Nueva medición agregada correctamente.</span>
                </div>
            @endif
            {{-- MENSAJE DE ÉXITO PARA PRESCRIPCIÓN --}}
            @if (session('status') === 'prescripcion-agregada')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative dark:bg-emerald-900 dark:border-emerald-600 dark:text-emerald-300" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">Nueva prescripción agregada correctamente.</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
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

                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-8">
                    
                    {{-- Bloque de Agregar Nueva Medición --}}
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                            Agregar Nueva Medición
                        </h3>

                        <form method="post" action="{{ route('doctor.pacientes.mediciones.agregar', $user) }}" class="mt-6 space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="fecha" :value="__('Fecha de Medición')" />
                                    <x-text-input id="fecha" name="fecha" type="date" class="mt-1 block w-full" :value="old('fecha')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
                                </div>

                                <div>
                                    <x-input-label for="glucosa" :value="__('Nivel de Glucosa (mg/dL)')" /> 
                                    <x-text-input id="glucosa" name="glucosa" type="number" step="0.1" class="mt-1 block w-full" :value="old('glucosa')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('glucosa')" />
                                </div>

                                <div>
                                    <x-input-label for="presionSistolica" :value="__('Presión Arterial (Sistólica)')" />
                                    <x-text-input id="presionSistolica" name="presionSistolica" type="text" class="mt-1 block w-full" placeholder="120" :value="old('presionSistolica')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('presionSistolica')" />
                                </div>

                                <div>
                                    <x-input-label for="presionDiastolica" :value="__('Presión Arterial (Diastólica)')" />
                                    <x-text-input id="presionDiastolica" name="presionDiastolica" type="text" class="mt-1 block w-full" placeholder="80" :value="old('presionDiastolica')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('presionDiastolica')" />
                                </div>

                                <div>
                                    <x-input-label for="peso" :value="__('Peso (kg)')" />
                                    <x-text-input id="peso" name="peso" type="number" step="0.1" class="mt-1 block w-full" :value="old('peso')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('peso')" />
                                </div>

                                <div>
                                    <x-input-label for="altura" :value="__('Altura (cm)')" />
                                    <x-text-input id="altura" name="altura" type="number" step="0.1" class="mt-1 block w-full" :value="old('altura')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('altura')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="notas" :value="__('Notas del Paciente')" />
                                <textarea id="notas" name="notas" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('notas') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('notas')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Agregar Medición') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div><br>
                    
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                            Mediciones Anteriores
                        </h3>

                        @if($user->paciente && $user->paciente->mediciones->count() > 0)
                            <div class="mt-6 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Glucosa</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Presión Arterial</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Peso</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Altura</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Notas</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($user->paciente->mediciones->sortByDesc('fecha') as $medicion)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->fecha ? \Carbon\Carbon::parse($medicion->fecha)->format('d/m/Y') : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->glucosa ? $medicion->glucosa . ' mg/dL' : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->presionSistolica && $medicion->presionDiastolica ? $medicion->presionSistolica . '/' . $medicion->presionDiastolica : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->peso ? $medicion->peso . ' kg' : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->altura ? $medicion->altura . ' cm' : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->notas ?: 'Sin notas' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                                <p>No hay mediciones registradas para este paciente.</p>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
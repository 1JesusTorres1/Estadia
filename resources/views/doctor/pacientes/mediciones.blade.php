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
            
            @if (session('status') === 'prescripcion-agregada')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative dark:bg-emerald-900 dark:border-emerald-600 dark:text-emerald-300" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">Nueva prescripción agregada correctamente.</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6 self-start">
                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-gray-100 border-b border-indigo-200 dark:border-indigo-700 pb-3 mb-4">
                        Detalles del Paciente
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }} {{ $user->apellido }}</p>
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
                </div>

                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-gray-100 border-b border-indigo-200 dark:border-indigo-700 pb-3 mb-6">
                            Agregar Nueva Medición
                        </h3>

                        <form method="post" action="{{ route('doctor.pacientes.mediciones.agregar', $user) }}" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                                <div>
                                    <x-input-label for="fecha" :value="__('Fecha de Medición')" />
                                    <x-text-input id="fecha" name="fecha" type="date" class="mt-1 block w-full" :value="old('fecha')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
                                </div>

                                <div>
                                    <x-input-label for="glucosa" :value="__('Glucosa (mg/dL)')" />
                                    <x-text-input id="glucosa" name="glucosa" type="number" step="0.1" class="mt-1 block w-full" :value="old('glucosa')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('glucosa')" />
                                </div>

                                <div>
                                    <x-input-label for="hemoglobina" :value="__('Hemoglobina (g/dL)')" />
                                    <x-text-input id="hemoglobina" name="hemoglobina" type="number" step="0.1" class="mt-1 block w-full" :value="old('hemoglobina')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('hemoglobina')" />
                                </div>

                                <div>
                                    <x-input-label for="presionSistolica" :value="__('P. Sistólica (mmHg)')" />
                                    <x-text-input id="presionSistolica" name="presionSistolica" type="text" class="mt-1 block w-full" placeholder="120" :value="old('presionSistolica')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('presionSistolica')" />
                                </div>

                                <div>
                                    <x-input-label for="presionDiastolica" :value="__('P. Diastólica (mmHg)')" />
                                    <x-text-input id="presionDiastolica" name="presionDiastolica" type="text" class="mt-1 block w-full" placeholder="80" :value="old('presionDiastolica')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('presionDiastolica')" />
                                </div>

                                <div>
                                    <x-input-label for="fatiga" :value="__('Nivel de Fatiga (1-10)')" />
                                    <x-text-input id="fatiga" name="fatiga" type="text" class="mt-1 block w-full" placeholder="5" :value="old('fatiga')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('fatiga')" />
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

                                <div>
                                    <x-input-label for="visionborrosa" :value="__('¿Tiene visión borrosa?')" />
                                    <select id="visionborrosa" name="visionborrosa"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600
                                            rounded-md shadow-sm">
                                        <option value="">Seleccione...</option>
                                        <option value="Sí" @if(old('visionborrosa') == 'Sí') selected @endif>Sí</option>
                                        <option value="No" @if(old('visionborrosa') == 'No') selected @endif>No</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('visionborrosa')" />
                                </div>

                                <div>
                                    <x-input-label for="hormigueo" :value="__('¿Sufre de hormigueo?')" />
                                    <select id="hormigueo" name="hormigueo"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600
                                            rounded-md shadow-sm">
                                        <option value="">Seleccione...</option>
                                        <option value="Sí" @if(old('hormigueo') == 'Sí') selected @endif>Sí</option>
                                        <option value="No" @if(old('hormigueo') == 'No') selected @endif>No</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('hormigueo')" />
                                </div>

                                <div class="lg:col-span-3">
                                    <x-input-label for="notas" :value="__('Notas y Comentarios (Comorbilidades, Observaciones, etc.)')" />
                                    <textarea id="notas" name="notas"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600
                                            rounded-md shadow-sm" rows="4">{{ old('notas') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('notas')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Guardar Medición') }}</x-primary-button>
                            </div>
                        </form>

                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-gray-100 border-b border-indigo-200 dark:border-indigo-700 pb-3 mb-6">
                            Historial de Mediciones
                        </h3>

                        @if($user->paciente && $user->paciente->mediciones->count() > 0)
                            <div class="mt-6 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Glucosa</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">P. Arterial</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">HbA1c</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Peso/Altura</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fatiga</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Visión Borr.</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Hormigueo</th>
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
                                                    {{ $medicion->hemoglobina ?: 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->peso ? $medicion->peso . ' kg' : 'N/A' }} / {{ $medicion->altura ? $medicion->altura . ' cm' : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->fatiga ?: 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->visionBorrosa ?: 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $medicion->hormigueo ?: 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 truncate max-w-xs">
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

                    <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-gray-100 border-b border-indigo-200 dark:border-indigo-700 pb-3 mb-6">
                            Agregar Nuevo estudio
                        </h3>
                        <form method="POST" action="{{ route('doctor.pacientes.estudios.agregar', $user) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Tipo de estudio --}}
                            <div>
                                <x-input-label for="tipo_estudio" :value="__('Tipo de estudio')" />
                                <x-text-input id="tipo_estudio" name="tipo_estudio" type="text" class="mt-1 block w-full"
                                    placeholder="Ejemplo: Análisis de sangre" :value="old('tipo_estudio')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tipo_estudio')" />
                            </div>

                            {{-- Fecha del estudio --}}
                            <div>
                                <x-input-label for="fecha_estudio" :value="__('Fecha del estudio')" />
                                <x-text-input id="fecha_estudio" name="fecha_estudio" type="date" class="mt-1 block w-full"
                                    :value="old('fecha_estudio')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_estudio')" />
                            </div>

                            {{-- Estatus --}}
                            <div>
                                <x-input-label for="estatus" :value="__('Estatus')" />
                                <select id="estatus" name="estatus"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="pendiente" @if(old('estatus') == 'pendiente') selected @endif>Pendiente</option>
                                    <option value="en revisión" @if(old('estatus') == 'en revisión') selected @endif>En revisión</option>
                                    <option value="completado" @if(old('estatus') == 'completado') selected @endif>Completado</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('estatus')" />
                            </div>

                            {{-- Descripción --}}
                            <div class="lg:col-span-3">
                                <x-input-label for="descripcion" :value="__('Descripción del estudio')" />
                                <textarea id="descripcion" name="descripcion" rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                            </div>

                            {{-- Resultado --}}
                            <div class="lg:col-span-3">
                                <x-input-label for="resultado" :value="__('Resultado del estudio')" />
                                <textarea id="resultado" name="resultado" rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('resultado') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('resultado')" />
                            </div>

                            {{-- Observaciones del doctor --}}
                            <div class="lg:col-span-3">
                                <x-input-label for="observaciones_doctor" :value="__('Observaciones del doctor')" />
                                <textarea id="observaciones_doctor" name="observaciones_doctor" rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('observaciones_doctor') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('observaciones_doctor')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Guardar Estudio') }}</x-primary-button>
                        </div>
                    </form>
                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-gray-100 border-b border-indigo-200 dark:border-indigo-700 pb-3 mb-6">
                            Historial de Estudios Médicos
                        </h3>

                        @if($user->paciente && $user->paciente->estudiosMedicos->count() > 0)
                            <div class="mt-6 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo de Estudio</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estatus</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Resultado</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Desc. / Obs.</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($user->paciente->estudiosMedicos->sortByDesc('fecha_estudio') as $estudio)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $estudio->fecha_estudio ? \Carbon\Carbon::parse($estudio->fecha_estudio)->format('d/m/Y') : 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600 dark:text-indigo-400">
                                                    {{ $estudio->tipo_estudio }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($estudio->estatus === 'completado') bg-emerald-100 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-100
                                                        @elseif($estudio->estatus === 'en revisión') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                                        {{ ucfirst($estudio->estatus) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 max-w-xs truncate" title="{{ $estudio->resultado }}">
                                                    {{ $estudio->resultado ?: 'Pendiente de resultado' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate" title="{{ $estudio->descripcion }} / {{ $estudio->observaciones_doctor }}">
                                                    {{ $estudio->descripcion ?: 'Sin descripción' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                                <p>No hay estudios médicos registrados para este paciente.</p>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

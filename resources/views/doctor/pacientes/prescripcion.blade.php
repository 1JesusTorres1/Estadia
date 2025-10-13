<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Prescripciones para: <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }} {{ $user->apellido }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Recetar Nuevo Medicamento
                </h3>

                <form method="post" action="{{ route('doctor.pacientes.prescripcion.agregar', $user) }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="col-span-2">
                            <x-input-label for="medicamento_id" :value="__('Medicamento')" />
                            <select id="medicamento_id" name="medicamento_id" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Selecciona un medicamento</option>
                                @foreach($medicamentos as $medicamento)
                                    <option value="{{ $medicamento->id }}" 
                                        {{ old('medicamento_id') == $medicamento->id ? 'selected' : '' }}>
                                        {{ $medicamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('medicamento_id')" />
                        </div>

                        <div>
                            <x-input-label for="dosis" :value="__('Dosis y Frecuencia')" />
                            <x-text-input id="dosis" name="dosis" type="text" class="mt-1 block w-full" placeholder="Ej: 10mg c/12h" :value="old('dosis')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('dosis')" />
                        </div>

                        <div>
                            <x-input-label for="fecha_prescripcion" :value="__('Fecha de inicio')" />
                            <x-text-input id="fecha_prescripcion" name="fecha_prescripcion" type="date" class="mt-1 block w-full" :value="old('fecha_prescripcion', \Carbon\Carbon::now()->toDateString())" required />
                            <x-input-error class="mt-2" :messages="$errors->get('fecha_prescripcion')" />
                        </div>

                        <div>
                            <x-input-label for="fecha_fin_consumo" :value="__('Fecha de termino')" />
                            <x-text-input id="fecha_fin_consumo" name="fecha_fin_consumo" type="date" class="mt-1 block w-full" :value="old('fecha_fin_consumo')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('fecha_fin_consumo')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="indicaciones" :value="__('Indicaciones Adicionales (Opcional)')" />
                        <textarea id="indicaciones" name="indicaciones" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('indicaciones') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('indicaciones')" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>{{ __('Recetar y Guardar') }}</x-primary-button>
                    </div>
                </form>
            </div>
            <br>
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Historial de Prescripciones
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
    </div>
</x-app-layout>
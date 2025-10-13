<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Mediciones del Paciente: <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }} {{ $user->apellido }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

                <!-- Columna de Mediciones -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3 mt-8">
                        Mediciones 
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
                            <p>Actualmente no cuenta con alguna medición.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
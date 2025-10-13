<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Mi Historial Médico
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Columna de Información del Paciente -->
                <div class="lg:col-span-1 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 self-start">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                        Mi Información
                    </h3>
                    <div class="space-y-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }} {{ $user->apellido }}</p>
                        </div>
                        @if($user->paciente)
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Diabetes</p>
                                <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $user->paciente->tipoDiabetes }}</p>
                            </div>
                        @endif
                    </div>
                </div><br>

                <!-- Columna del Historial Médico (Solo Lectura) -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                     <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
                        Detalles del Historial
                    </h3>
                    
                    @if($user->paciente && $user->paciente->historialMedico)
                        <div class="mt-6 space-y-6">
                            <div>
                                <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">Antecedentes Familiares</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $user->paciente->historialMedico->antecedentesFamiliares ?? 'No especificado' }}</p>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">Alergias Conocidas</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $user->paciente->historialMedico->alergias ?? 'No especificado' }}</p>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">Otras Enfermedades Relevantes</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $user->paciente->historialMedico->enfermedades ?? 'No especificado' }}</p>
                            </div>
                             <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">Notas Médicas Adicionales</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $user->paciente->historialMedico->notasMedicas ?? 'No especificado' }}</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                            <p>Tu historial médico aún no ha sido completado por un doctor.</p>
                        </div>
                    @endif

                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <a href="{{ route('paciente.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Volver al Panel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


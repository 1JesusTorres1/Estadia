<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultar citas médicas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                    Volver al panel
                </a>
                <a href="{{ route('paciente.citas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                    Agendar cita
                </a>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">
                    Próximas citas
                </h3>
                
                @forelse ($proximasCitas as $cita)
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border border-l-4 border-indigo-500/50">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            
                            {{-- Columna 1: Fecha/Hora --}}
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $cita->fecha_hora->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hora</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $cita->fecha_hora->format('H:i') }}</p>
                            </div>
                            
                            {{-- Columna 2: Profesional y Motivo --}}
                            <div class="col-span-2 mt-4 md:mt-0">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Motivo</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $cita->motivo }}</p>
                            </div>

                            {{-- Fila Adicional para Doctor --}}
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Profesional</p>
                                <p class="text-base font-semibold text-indigo-600 dark:text-indigo-400">
                                    Dr(a). {{ $cita->doctor->name }} {{ $cita->doctor->apellido }}
                                </p>
                            </div>
                            
                            {{-- Estado y Notas --}}
                            <div class="col-span-2 text-right">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium 
                                    @if($cita->estado == 'confirmada') bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300
                                    @elseif($cita->estado == 'pendiente') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white dark:bg-gray-800 sm:rounded-lg shadow-sm text-gray-600 dark:text-gray-400">
                        <p>No tienes citas programadas próximamente. ¡Agenda una!</p>
                    </div>
                @endforelse
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2 pt-4">
                    Citas pasadas
                </h3>

                @forelse ($citasPasadas as $cita)
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 opacity-80">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            
                            {{-- Fila principal: Fecha/Motivo --}}
                            <div class="col-span-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2 mb-2">
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $cita->fecha_hora->format('d M Y') }} — {{ $cita->motivo }}
                                </p>
                                <span class="px-3 py-0.5 rounded-full text-sm font-medium 
                                    @if($cita->estado == 'atendida') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </div>

                            {{-- Detalles: Profesional y Notas --}}
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Profesional</p>
                                <p class="text-base text-gray-800 dark:text-gray-200">
                                    Dr(a). {{ $cita->doctor->name }} {{ $cita->doctor->apellido }}
                                </p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Notas</p>
                                <p class="text-base text-gray-800 dark:text-gray-200">
                                    {{ $cita->notas_doctor ?: 'No hay notas registradas por el profesional.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white dark:bg-gray-800 sm:rounded-lg shadow-sm text-gray-600 dark:text-gray-400">
                        <p>Aún no tienes citas pasadas registradas.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
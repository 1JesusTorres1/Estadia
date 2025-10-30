<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agendar Cita Médica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                
                @if (session('status') === 'cita-agendada')
                    <div class="mb-4 text-emerald-700 dark:text-emerald-400">
                        ¡Cita agendada con éxito!
                    </div>
                @endif
                
                <form method="POST" action="{{ route('paciente.citas.store') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="doctor_id" :value="__('Seleccionar Profesional')" />
                        <select id="doctor_id" name="doctor_id" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">-- Selecciona un Doctor --</option>
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }} {{ $doctor->apellido }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('doctor_id')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="fecha" :value="__('Fecha')" />
                            <x-text-input id="fecha" name="fecha" type="date" min="{{ now()->toDateString() }}" class="mt-1 block w-full" :value="old('fecha')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
                            {{-- NOTA: Aquí iría la lógica JavaScript/Livewire para filtrar las HORAS DISPONIBLES después de elegir la fecha --}}
                        </div>
                        
                        <div>
                            <x-input-label for="hora" :value="__('Hora')" />
                            {{-- Simulación de select de horas. En una app real, esto debería ser dinámico --}}
                            <select id="hora" name="hora" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <option value="">-- Selecciona Hora --</option>
                                <option value="09:00" {{ old('hora') == '09:00' ? 'selected' : '' }}>09:00</option>
                                <option value="10:00" {{ old('hora') == '10:00' ? 'selected' : '' }}>10:00</option>
                                <option value="11:00" {{ old('hora') == '11:00' ? 'selected' : '' }}>11:00</option>
                                <option value="12:00" {{ old('hora') == '12:00' ? 'selected' : '' }}>12:00</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('hora')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="motivo" :value="__('Motivo de la Cita')" />
                        <x-text-input id="motivo" name="motivo" type="text" class="mt-1 block w-full" :value="old('motivo')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('motivo')" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>{{ __('Agendar Cita') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
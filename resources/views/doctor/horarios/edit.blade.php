<x-app-layout>
    {{-- Establecer la localización de Carbon a español --}}
    @php
        \Carbon\Carbon::setLocale('es');
    @endphp

    <div class="space-y-8 max-w-4xl mx-auto py-10">
        {{-- Título y Subtítulo --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Editar Horario</h1>
            <p class="text-sm text-gray-500">Modifica el horario registrado para el {{ \Carbon\Carbon::parse($horario->fechaHorario)->translatedFormat('l, d F Y') }}.</p>
        </div>

        {{-- Mostrar errores de validación (como el de duplicidad) --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Oops! Hubo un problema:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 w-full">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modificar Horario Existente</h2>

            {{-- Formulario para ACTUALIZAR --}}
            {{-- Importante: apunta a 'update' y usa el método @method('PUT') --}}
            <form action="{{ route('doctor.horarios.update', $horario) }}" method="POST" class="grid grid-cols-6 gap-4 items-end">
                @csrf
                @method('PUT') {{-- Esto es crucial para que Laravel use el método update --}}

                {{-- Día --}}
                <div class="flex flex-col col-span-2">
                    <label class="text-gray-500 text-sm font-medium mb-1 block">Día</label>
                    {{-- Usa old() para mantener el valor si hay un error, o el valor actual si no hay error --}}
                    <input type="date" name="fechaHorario" value="{{ old('fechaHorario', $horario->fechaHorario) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('fechaHorario') border-red-500 @enderror" required>
                    @error('fechaHorario')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Hora inicio --}}
                <div class="flex flex-col col-span-2">
                    <label class="text-gray-500 text-sm font-medium mb-1 block">Hora inicio</label>
                    <input type="time" name="horaInicio" value="{{ old('horaInicio', $horario->horaInicio) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('horaInicio') border-red-500 @enderror" required>
                    @error('horaInicio')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Hora término --}}
                <div class="flex flex-col col-span-2">
                    <label class="text-gray-500 text-sm font-medium mb-1 block">Hora término</label>
                    <input type="time" name="horaFin" value="{{ old('horaFin', $horario->horaFin) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('horaFin') border-red-500 @enderror" required>
                    @error('horaFin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones de acción --}}
                <div class="col-span-6 flex space-x-4 pt-4">
                    <button type="submit" class="bg-blue-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-150 shadow-sm">
                        Actualizar Horario
                    </button>
                    {{-- Botón para cancelar y volver al listado --}}
                    <a href="{{ route('doctor.horarios.index') }}" class="text-gray-600 font-medium px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition duration-150">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    @php \Carbon\Carbon::setLocale('es'); @endphp

    <div class="space-y-10 max-w-5xl mx-auto py-10">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 text-sm px-4 py-3 rounded-lg border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 text-sm px-4 py-3 rounded-lg border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Horario y Registros</h1>
            <p class="text-sm text-gray-500">Gestiona y revisa tu historial de horarios de atención.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 max-w-xl mx-auto w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-5 text-center">Registrar Nuevo Horario</h2>

            <form action="{{ route('doctor.horarios.store') }}" method="POST" class="grid grid-cols-1 gap-5">
                @csrf

                <div class="flex flex-col">
                    <label class="text-gray-600 text-sm font-medium mb-1">Día</label>
                    <input type="date" name="fechaHorario" class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="text-gray-600 text-sm font-medium mb-1">Hora inicio</label>
                        <input type="time" name="horaInicio" class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-600 text-sm font-medium mb-1">Hora término</label>
                        <input type="time" name="horaFin" class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <button type="submit" class="bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 transition duration-150 shadow-md">
                    Guardar
                </button>
            </form>
        </div>
        <br>
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 max-w-xl mx-auto w-full">
            <h2 class="text-lg font-semibold text-gray-800">Historial de Horarios Registrados</h2>

            <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-100">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Inicio</th>
                            <th class="p-3">Fin</th>
                            <th class="p-3">Registrado hace</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($horarios as $horario)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ \Carbon\Carbon::parse($horario->fechaHorario)->translatedFormat('d/m/Y') }}</td>
                                <td class="p-3">{{ $horario->horaInicio }}</td>
                                <td class="p-3">{{ $horario->horaFin }}</td>
                                <td class="p-3">{{ $horario->created_at->diffForHumans() }}</td>
                                <td class="p-3 flex justify-center space-x-4">
                                    <a href="{{ route('doctor.horarios.edit', $horario) }}"
                                       class="text-indigo-600 hover:underline font-medium">Editar</a>

                                    <form action="{{ route('doctor.horarios.destroy', $horario) }}" method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este horario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3 text-center text-gray-500" colspan="5">No hay horarios registrados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>

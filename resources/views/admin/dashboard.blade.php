<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <a href="{{ route('admin.usuarios.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">👤 Gestión de Usuarios</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Administrar cuentas de usuarios y roles.</p>
            </a>

            <a href="{{ route('admin.reportes') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">📊 Reportes</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Generar reportes dinámicos del sistema.</p>
            </a>

            <a href="{{ route('admin.medicamentos.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">💊 Medicamentos</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Gestionar catálogo de medicamentos.</p>
            </a>

            <a href="{{ route('admin.backup.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">💾 Respaldo y Restauración</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Crear y restaurar copias de seguridad.</p>
            </a>

        </div>
    </div>
</x-app-layout>
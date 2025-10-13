<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel del Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Saludo de Bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">¡Bienvenido de nuevo, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Aquí puedes gestionar tu información de salud, citas y más.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Columna de Resumen (ocupa 1 de 3 columnas en pantallas grandes) -->
                <div class="lg:col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">Resumen Rápido</h4>
                    <div class="space-y-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name . ' ' . Auth::user()->apellido }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Correo Electrónico</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->email }}</p>
                        </div>
                        @if(Auth::user()->paciente)
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Diabetes</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->paciente->tipoDiabetes }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</p>
                            <p class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->paciente->fecha_nacimiento ? Auth::user()->paciente->fecha_nacimiento->format('d M, Y') : 'No especificada' }}</p>
                        </div>
                        @endif
                    </div>
                </div><br>

                <!-- Columna de Acciones (ocupa 2 de 3 columnas en pantallas grandes) -->
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <!-- Perfil -->
                    <a href="{{ route('profile.edit') }}" 
                       class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-full">
                            <!-- Icono SVG -->
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Mi Perfil</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Edita tu información personal.</p>
                        </div>
                    </a><br>

                    <!-- Citas Médicas -->
                    <a href="#" 
                       class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-sky-100 dark:bg-sky-900 p-3 rounded-full">
                            <!-- Icono SVG -->
                            <svg class="w-6 h-6 text-sky-600 dark:text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-sky-600 dark:group-hover:text-sky-400">Mis Citas Médicas</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Consulta y agenda tus citas.</p>
                        </div>
                    </a><br>

                    <!-- Medicamentos -->
                    <a href="{{ route('paciente.prescripciones') }}" 
                       class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-emerald-100 dark:bg-emerald-900 p-3 rounded-full">
                           <!-- Icono SVG -->
                           <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M8.5 11.536V14h7v-2.464l1.357-1.357A3.5 3.5 0 0 0 14.5 7h-5a3.5 3.5 0 0 0-2.357 3.179L8.5 11.536zM15 4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v2h6V4z"/><path d="M19 8h-2V4a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v4H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h15a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2zM9 5h5v2H9V5zm7 15H7v-7h9v7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Medicamentos</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Administra tus tratamientos.</p>
                        </div>
                    </a><br>

                    <!-- Historial Médico -->
                    <a href="{{ route('paciente.historialMedico') }}" 
                       class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-rose-100 dark:bg-rose-900 p-3 rounded-full">
                           <svg class="w-6 h-6 text-rose-600 dark:text-rose-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20.41,12.92,12,21.33,3.59,12.92a7,7,0,0,1,9.9-9.9l.51.5.51-.5a7,7,0,0,1,9.9,9.9Z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-rose-600 dark:group-hover:text-rose-400">Mi Historial Médico</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Consulta tu historial completo.</p>
                        </div>
                    </a><br>

                    <!-- Mediciones -->
                     <a href="{{ route('paciente.mediciones') }}" 
                       class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center space-x-4 hover:shadow-xl hover:scale-105 transition-transform duration-200">
                        <div class="bg-rose-100 dark:bg-rose-900 p-3 rounded-full">
                           <svg class="w-6 h-6 text-rose-600 dark:text-rose-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20.41,12.92,12,21.33,3.59,12.92a7,7,0,0,1,9.9-9.9l.51.5.51-.5a7,7,0,0,1,9.9,9.9Z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-rose-600 dark:group-hover:text-rose-400">Mis Mediciones</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Consulta tus mediciones de glucosa, presión, altura, etc.</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

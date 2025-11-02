<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiaControl - Sistema de Control de Diabetes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="grid md:grid-cols-2">
            <!-- Lado Izquierdo - Información -->
            <div class="p-10 bg-gradient-to-br from-gray-50 to-blue-50">
                <!-- Imagen del glucómetro -->
                <div class="mb-6 bg-gradient-to-br from-orange-50 to-blue-50 rounded-2xl p-8 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=300&h=250&fit=crop" 
                         alt="Glucómetro" 
                         class="w-48 h-48 object-contain drop-shadow-lg">
                </div>

                <!-- Título -->
                <h2 class="text-2xl font-bold text-gray-900 mb-3">
                    ¿Qué es la diabetes?
                </h2>

                <!-- Descripción -->
                <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                    La diabetes es una condición crónica que afecta la forma en que el cuerpo convierte los alimentos en energía. Requiere monitoreo de glucosa, actividad física y adherencia al tratamiento.
                </p>

                <!-- Beneficios -->
                <div class="space-y-3">
                    <div class="flex items-start gap-3 bg-white p-4 rounded-xl">
                        <div class="mt-0.5">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm">
                            Control regular de glucosa ayuda a prevenir complicaciones.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 bg-white p-4 rounded-xl">
                        <div class="mt-0.5">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm">
                            La adherencia a la medicación mejora los resultados clínicos.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 bg-white p-4 rounded-xl">
                        <div class="mt-0.5">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 text-sm">
                            Hábitos saludables reducen el riesgo cardiovascular.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Lado Derecho - Autenticación -->
            <div class="p-10 flex flex-col justify-center">
                <!-- Logo y Título -->
                <div class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h1 class="text-xl font-semibold text-gray-900">DiaControl</h1>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="space-y-3">
                    @auth
                        <!-- Si el usuario está autenticado -->
                        <a href="/dashboard" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Ir al Dashboard</span>
                        </a>
                    @else
                        <!-- Si el usuario NO está autenticado -->
                        <a href="/login" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Iniciar sesión</span>
                        </a>

                        <a href="/register" 
                           class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-colors border border-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Registrarse</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>
</html>
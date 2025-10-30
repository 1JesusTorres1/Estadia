<div class="mb-8 p-4 bg-gray-50 rounded-lg">
    <h4 class="font-bold text-lg text-blue-700">
    </h4>
    <p class="text-sm text-gray-500">{{ auth()->user()->email ?? 'sin.correo@ejemplo.com' }}</p>
</div>

<div>
    <h5 class="text-sm font-semibold uppercase text-gray-500 mb-3">Menú</h5>
    
    @if(auth()->check() && (auth()->user()->rol === 'doctor' || auth()->user()->rol === 'admin'))
        
        <a href="{{ route('doctor.dashboard') }}" 
           class="block p-3 mb-2 rounded-lg 
           {{ Request::routeIs('doctor.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} 
           transition duration-150">
            Agenda
        </a>
        
        <a href="{{ route('doctor.pacientes') }}" 
           class="block p-3 mb-2 rounded-lg 
           {{ Request::routeIs('doctor.pacientes') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} 
           transition duration-150">
            Pacientes
        </a>
        
    @endif
    
</div>
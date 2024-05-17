@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-blue-900">Detalles de la Bitácora</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-white">ID de Bitácora: {{ $bitacora->id }}</h2>
            <div class="text-xl font-bold text-white">{{ $bitacora->cliente->nombre }}</div>
        </div>
        <div class="px-6 py-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray-100 rounded-lg p-4 sm:p-6 transform hover:scale-105 transition duration-300">
                <h3 class="text-xl font-semibold mb-2">Fecha de Recepción</h3>
                <p class="text-gray-600">{{ $bitacora->fecha_recepcion }}</p>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 sm:p-6 transform hover:scale-105 transition duration-300">
                <h3 class="text-xl font-semibold mb-2">Huevos al Inicio</h3>
                <p class="text-gray-600">{{ $bitacora->huevos_inicio }}</p>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 sm:p-6 transform hover:scale-105 transition duration-300">
                <h3 class="text-xl font-semibold mb-2">Huevos Malos</h3>
                <p class="text-gray-600">{{ $bitacora->huevos_malos }}</p>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 sm:p-6 transform hover:scale-105 transition duration-300">
                <h3 class="text-xl font-semibold mb-2">Huevos Incubados</h3>
                <p class="text-gray-600">{{ $bitacora->huevos_incubados }}</p>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 sm:p-6 transform hover:scale-105 transition duration-300">
                <h3 class="text-xl font-semibold mb-2">Fecha de Entrega</h3>
                <p class="text-gray-600">{{ $bitacora->fecha_entrega }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

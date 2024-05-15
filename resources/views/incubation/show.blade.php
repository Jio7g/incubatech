@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white px-6 py-4">
            <h1 class="text-2xl font-bold mb-2">Detalles de Recepción de Huevos</h1>
            <p class="text-sm">ID de incubationData: {{ $incubationData->id }}</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-100 rounded-lg p-4">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Información del Cliente</h2>
                    <div class="mb-2">
                        <span class="font-semibold">Nombre:</span>
                        <span class="ml-2">{{ $incubationData->cliente->nombre }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Fecha de Recepción:</span>
                        <span class="ml-2">{{ $incubationData->fecha_recepcion }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Fecha de Entrega:</span>
                        <span class="ml-2">{{ $incubationData->fecha_entrega }}</span>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-4">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Detalles de Incubación</h2>
                    <div class="mb-2">
                        <span class="font-semibold">Etapa:</span>
                        <span class="ml-2">{{ $incubationData->etapa }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Estado:</span>
                        <span class="ml-2">{{ $incubationData->estado }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Huevos al Inicio:</span>
                        <span class="ml-2">{{ $incubationData->cantidad }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Huevos Malos:</span>
                        <span class="ml-2">{{ $incubationData->huevos_malos }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Huevos Eclosionados:</span>
                        <span class="ml-2">{{ $incubationData->huevos_eclosionados }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Huevos Incubados:</span>
                        <span class="ml-2">{{ $incubationData->huevos_proceso }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Descripción</h2>
                <div class="bg-gray-100 rounded-lg p-4">
                    <p class="text-gray-700">{{ $incubationData->descripcion }}</p>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <a href="{{ route('incubation.index') }}" class="bg-gray-800 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver
                </a>

                <a href="{{ route('incubation.imprimir', $incubationData->id) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                    </svg>
                    Imprimir
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

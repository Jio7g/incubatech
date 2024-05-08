@auth
@extends('layouts.app')
@endauth

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Información de incubación de {{ $client->nombre }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($incubations as $incubation)
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="mb-4">
                <h2 class="text-xl font-bold">{{ $incubation->producto }}</h2>
                <p class="text-gray-500">Fecha de Recepción: {{ $incubation->fecha_recepcion }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Cantidad:</strong> {{ $incubation->cantidad }}</p>
                <p><strong>Tipo de Huevo:</strong> {{ $incubation->tipo_huevo }}</p>
                <p><strong>No. Bandeja:</strong> {{ $incubation->numero_bandeja }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Etapa:</strong> {{ $incubation->etapa }}</p>
                <p><strong>Estado:</strong> {{ $incubation->estado }}</p>
            </div>
            <div>
                <p><strong>Descripción:</strong></p>
                <p class="text-gray-600">{{ $incubation->descripcion }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

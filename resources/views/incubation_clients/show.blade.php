@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Incubaciones de {{ $client->nombre }}</h1>
    <div class="mb-6">
        <p class="text-gray-600">
            <strong>Dirección:</strong> {{ $client->direccion }}<br>
            <strong>Teléfono:</strong> {{ $client->telefono }}
        </p>
    </div>
    <div class="mb-6">
        <a href="{{ route('incubations_clients.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Volver a Incubaciones
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Fecha de Recepción</th>
                    <th class="py-3 px-6 text-left">Producto</th>
                    <th class="py-3 px-6 text-left">Cantidad</th>
                    <th class="py-3 px-6 text-left">Tipo de Huevo</th>
                    <th class="py-3 px-6 text-left">No. Bandeja</th>
                    <th class="py-3 px-6 text-left">Etapa</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($incubations as $incubation)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $incubation->fecha_recepcion }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->producto }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->cantidad }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->tipo_huevo }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->numero_bandeja }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->etapa }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->estado }}</td>
                    <td class="py-3 px-6 text-left">{{ $incubation->descripcion }}</td>
                    <td class="py-3 px-6 text-center">
                        <!-- botón de actualizar -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

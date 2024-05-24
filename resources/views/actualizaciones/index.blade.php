@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-2xl font-bold text-white mb-2">Actualizaciones de la Incubación de: {{ $incubacion->cliente->nombre ?? 'Cliente no especificado' }}</h1>
            <p class="text-gray-300">Producto: {{ $incubacion->producto }}</p>
            <p class="text-gray-300">Tipo: {{ $incubacion->tipo_huevo }}</p>
        </div>
        <div class="p-6">
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha de Actualización</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Descripción de la Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actualizaciones as $actualizacion)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $actualizacion->fecha_actualizacion }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $actualizacion->descripcion }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

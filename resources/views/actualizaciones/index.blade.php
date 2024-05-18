@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Actualizaciones de la Incubación de: {{ $incubacion->cliente->nombre ?? 'Cliente no especificado' }}</h1>
    <h1 class="text-2xl font-bold mb-4">Producto: {{ $incubacion->producto }}</h1>
    <h1 class="text-2xl font-bold mb-4">Tipo: {{ $incubacion->tipo_huevo }}</h1>


    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
    <table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha de Actualización</th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Descripcion de la Actualización</th>
            <!-- otros encabezados -->
        </tr>
    </thead>
    <tbody>
        @foreach ($actualizaciones as $actualizacion)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $actualizacion->fecha_actualizacion }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $actualizacion->descripcion }}</td>
            <!-- otras celdas -->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

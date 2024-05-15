@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Actualizar Incubación: {{ $incubacion->producto }}</h1>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="post" action="{{ route('actualizaciones.store') }}" class="max-w-lg mx-auto">
            @csrf
            <input type="hidden" name="incubacion_id" value="{{ $incubacion->id }}">
            <input type="hidden" name="cliente_id" value="{{ $incubacion->cliente_id }}">

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="huevos_inicio">
                    <i class="fas fa-egg mr-2"></i> Huevos Inicio:
                </label>
                <input class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" type="number" name="huevos_inicio" id="huevos_inicio" value="{{ old('huevos_inicio', $incubacion->huevos_proceso) }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="huevos_malos">
                    <i class="fas fa-times-circle mr-2"></i> Huevos Malos:
                </label>
                <input class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" type="number" name="huevos_malos" id="huevos_malos" value="{{ old('huevos_malos') }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="huevos_eclosionados">
                    <i class="fas fa-check-circle mr-2"></i> Huevos Eclosionados:
                </label>
                <input class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" type="number" name="huevos_eclosionados" id="huevos_eclosionados" value="{{ old('huevos_eclosionados') }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="etapa">
                    <i class="fas fa-tasks mr-2"></i> Etapa:
                </label>
                <input class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" type="text" name="etapa" id="etapa" value="{{ old('etapa') }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="estado">
                    <i class="fas fa-info-circle mr-2"></i> Estado:
                </label>
                <input class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" type="text" name="estado" id="estado" value="{{ old('estado') }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="descripcion">
                    <i class="fas fa-comment-alt mr-2"></i> Descripción:
                </label>
                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            <div class="text-center">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                    <i class="fas fa-save mr-2"></i> Guardar Actualización
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-3xl font-bold text-center text-white mb-6">Actualizar Incubación: {{ $incubacion->producto }}</h1>
        </div>
        <div class="p-6">
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
                        <i class="fas fa-times-circle mr-2"></i> Huevos No Fertiles:
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
                    <select class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" name="etapa" id="etapa" required>
                        <option value="">Seleccione una etapa</option>
                        <option value="recepcion" {{ old('etapa') == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                        <option value="ovoscopia" {{ old('etapa') == 'ovoscopia' ? 'selected' : '' }}>Ovoscopia</option>
                        <option value="taza fertilidad" {{ old('etapa') == 'taza fertilidad' ? 'selected' : '' }}>Taza de Fertilidad</option>
                        <option value="taza eclosion" {{ old('etapa') == 'taza eclosion' ? 'selected' : '' }}>Taza de Eclosión</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="estado">
                        <i class="fas fa-info-circle mr-2"></i> Estado:
                    </label>
                    <select class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" name="estado" id="estado" required>
                        <option value="">Seleccione un estado</option>
                        <option value="recepcion" {{ old('estado') == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                        <option value="en proceso" {{ old('estado') == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="descripcion">
                        <i class="fas fa-comment-alt mr-2"></i> Descripción:
                    </label>
                    <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('incubations.show', $incubacion->cliente_id) }}" class="bg-gray-800 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Volver a las Incubaciones
                    </a>

                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center" type="submit">
                        <i class="fas fa-save mr-2"></i> Guardar Actualización
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

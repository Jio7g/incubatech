@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white">Editar Datos de Incubación</h1>
        </div>
        <div class="p-6">
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('incubation.update', $incubationData->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fecha_recepcion" class="block text-gray-700 font-bold mb-2">Fecha Recepción</label>
                        <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_recepcion" name="fecha_recepcion" value="{{ $incubationData->fecha_recepcion }}" required>
                    </div>

                    <div>
                        <label for="cliente_id" class="block text-gray-700 font-bold mb-2">Id Cliente</label>
                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cliente_id" name="cliente_id" value="{{ $incubationData->cliente_id }}" required>
                    </div>

                    <div>
                        <label for="producto" class="block text-gray-700 font-bold mb-2">Producto</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="producto" name="producto" value="{{ $incubationData->producto }}" required>
                    </div>

                    <div>
                        <label for="cantidad" class="block text-gray-700 font-bold mb-2">Cantidad</label>
                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cantidad" name="cantidad" value="{{ $incubationData->cantidad }}" required>
                    </div>

                    <div>
                        <label for="tipo_huevo" class="block text-gray-700 font-bold mb-2">Tipo de Huevo</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tipo_huevo" name="tipo_huevo" value="{{ $incubationData->tipo_huevo }}" required>
                    </div>

                    <div>
                        <label for="numero_bandeja" class="block text-gray-700 font-bold mb-2">No. Bandeja</label>
                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="numero_bandeja" name="numero_bandeja" value="{{ $incubationData->numero_bandeja }}" required>
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
                </div>

                <div>
                        <label for="fecha_estimada" class="block text-gray-700 font-bold mb-2">Fecha Estimada</label>
                        <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_estimada" name="fecha_estimada" value="{{ $incubationData->fecha_estimada }}" required>
                </div>

                <div class="mt-6">
                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descripcion" name="descripcion" rows="3" required>{{ $incubationData->descripcion }}</textarea>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="{{ route('incubation.index') }}" class="bg-gray-800 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                        <svg class="h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

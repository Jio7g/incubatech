@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-3xl font-bold text-white">Editar Configuración</h1>
        </div>
        <div class="px-6 py-8">
            <form action="{{ route('configuracion.update', $configuracion->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nit_empresa" class="block text-gray-700 font-bold mb-2">NIT Empresa</label>
                        <input type="text" class="form-input w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="nit_empresa" name="nit_empresa" value="{{ $configuracion->nit_empresa }}" required>
                    </div>
                    <div>
                        <label for="nombre_empresa" class="block text-gray-700 font-bold mb-2">Nombre Empresa</label>
                        <input type="text" class="form-input w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="nombre_empresa" name="nombre_empresa" value="{{ $configuracion->nombre_empresa }}" required>
                    </div>
                    <div>
                        <label for="direccion_empresa" class="block text-gray-700 font-bold mb-2">Dirección Empresa</label>
                        <input type="text" class="form-input w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="direccion_empresa" name="direccion_empresa" value="{{ $configuracion->direccion_empresa }}" required>
                    </div>
                    <div>
                        <label for="telefono_empresa" class="block text-gray-700 font-bold mb-2">Teléfono Empresa</label>
                        <input type="text" class="form-input w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="telefono_empresa" name="telefono_empresa" value="{{ $configuracion->telefono_empresa }}" required>
                    </div>
                    <div>
                        <label for="correo_empresa" class="block text-gray-700 font-bold mb-2">Correo Empresa</label>
                        <input type="email" class="form-input w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="correo_empresa" name="correo_empresa" value="{{ $configuracion->correo_empresa }}" required>
                    </div>
                    <div>
                        <label for="logo_empresa" class="block text-gray-700 font-bold mb-2">Logo Empresa (actual)</label>
                        <div class="flex items-center">
                            <input type="file" class="form-input px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500" id="logo_empresa" name="logo_empresa">
                            @if($configuracion->logo_empresa)
                                <img src="{{ Storage::url($configuracion->logo_empresa) }}" alt="Logo actual" class="ml-4 w-32 rounded-lg shadow-md">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('configuracion.index') }}" class="bg-gray-800 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex items-center">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Regresar
                    </a>
                    <button type="submit" class="bg-blue-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

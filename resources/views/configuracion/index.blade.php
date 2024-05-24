@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-9xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-4 md:mb-0">Configuración de la Empresa</h1>
            <a href="{{ route('configuracion.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Crear Configuración
            </a>
        </div>
        <div class="p-6">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIT</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($configuraciones as $configuracion)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $configuracion->nit_empresa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $configuracion->nombre_empresa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $configuracion->direccion_empresa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $configuracion->telefono_empresa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $configuracion->correo_empresa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('configuracion.edit', $configuracion) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>
                                <form action="{{ route('configuracion.destroy', $configuracion) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar esta configuración?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

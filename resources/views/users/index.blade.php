{{-- resources/views/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>
    <div class="mb-4">
        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            NUEVO USUARIO
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->nombre }}</td>
                    <td class="px-4 py-2">{{ $user->correo }}</td>
                    <td class="px-4 py-2">{{ $user->rol }}</td>
                    <td class="px-4 py-2">
                        <!-- Botones de acción (editar, eliminar, etc.) -->
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded mr-2">
                            Editar
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
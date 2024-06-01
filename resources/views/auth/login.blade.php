{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')




@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="min-h-screen bg-gradient-to-r from-gray-800 to-blue-900 flex items-center justify-center">
    <div class="max-w-md w-full mx-auto">







        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="background-color: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="px-6 py-8">

                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">INICIAR SESIÓN</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Email</label>
                        <input type="email" id="correo" name="correo" class="block w-full px-4 py-2 border-0 rounded-lg leading-5 bg-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white sm:text-sm" placeholder="Email o Teléfono" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Password</label>
                        <input type="password" id="password" name="password" class="block w-full px-4 py-2 border-0 rounded-lg leading-5 bg-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white sm:text-sm" placeholder="Contraseña" required>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-300">
                                Recuérdame
                            </label>
                        </div>
                    </div>

                    <br>
                    <div class="mb-6">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">
                        Iniciar sesión
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app') <!-- Asume que tienes un layout llamado app.blade.php -->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 >INCIAR SESION</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="correo" class="form-label">Email</label>
                            <input type="correo" class="form-control" id="correo" name="correo" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Recuerdame</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-secondary">Login</button>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('password.request') }}">Olvidaste la contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

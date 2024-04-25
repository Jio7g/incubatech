{{-- resources/views/welcome.blade.php --}}


@section('content')
    <h1>Welcome to Our Application!</h1>
    <div class="login-form">
        @include('auth.login')
    </div>
    <div class="register-form">
        @include('auth.register')
    </div>
@endsection

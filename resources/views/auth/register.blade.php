@extends('layout.plantilla')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Registrarse</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="frm_register">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>

                        <div class="text-center mt-3">
                            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#frm_register").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Por favor ingrese su nombre completo",
                    minlength: "El nombre debe tener al menos 3 caracteres",
                    maxlength: "El nombre debe tener máximo 100 caracteres"
                },
                email: {
                    required: "Por favor ingrese su correo electrónico",
                    email: "Por favor ingrese un correo electrónico válido"
                },
                password: {
                    required: "Por favor ingrese una contraseña",
                    minlength: "La contraseña debe tener al menos 8 caracteres"
                },
                password_confirmation: {
                    required: "Por favor confirme su contraseña",
                    minlength: "La contraseña debe tener al menos 8 caracteres",
                    equalTo: "Las contraseñas no coinciden"
                }
            },
        });
    });
</script>

@endsection
@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4">Registrar Nuevo Tipo de Atracción</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipoAtraccion.store') }}" method="POST" id="frm_tipoAtraccion">
        @csrf
        <div class="mb-3">
            <label for="nombre_at" class="form-label">Nombre del Tipo de Atracción</label>
            <input type="text" class="form-control @error('nombre_at') is-invalid @enderror" 
                   id="nombre_at" name="nombre_at" value="{{ old('nombre_at') }}">
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar
        </button>
        <a href="{{ route('tipoAtraccion.index') }}" class="btn btn-secondary">
            <i class="fa fa-times"></i> Cancelar
        </a>
    </form>
</div>

<script>
    $(document).ready(function() {
        $("#frm_tipoAtraccion").validate({
            rules: {
                nombre_at: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                }
            },
            messages: {
                nombre_at: {
                    required: "Por favor ingrese el nombre del tipo de atracción",
                    minlength: "El nombre debe tener al menos 3 caracteres",
                    maxlength: "El nombre debe tener máximo 100 caracteres"
                }
            },
        });
    });
</script>

@endsection
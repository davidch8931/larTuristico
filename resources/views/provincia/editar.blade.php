@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4">Editar Provincia</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('provincias.update', $provincia->id) }}" method="POST" id="frm_provincia">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre_prov" class="form-label">Nombre de la Provincia</label>
            <input type="text" class="form-control @error('nombre_prov') is-invalid @enderror" 
                   id="nombre_prov" name="nombre_prov" 
                   value="{{ old('nombre_prov', $provincia->nombre_prov) }}">
            @error('nombre_prov')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Actualizar
        </button>
        <a href="{{ route('provincias.index') }}" class="btn btn-secondary">
            <i class="fa fa-times"></i> Cancelar
        </a>
    </form>
</div>
<script>
    $(document).ready(function() {
        $("#frm_provincia").validate({
            rules: {
                nombre_prov: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                }
            },
            messages: {
                nombre_prov: {
                    required: "Por favor ingrese el nombre de la provincia",
                    minlength: "El nombre de la provincia debe tener al menos 3 caracteres",
                    maxlength: "El nombre de la provincia debe tener máximo 100 caracteres"
                }
            },
        });
    });
</script>
@endsection
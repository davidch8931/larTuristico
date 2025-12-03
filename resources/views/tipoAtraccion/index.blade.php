@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4" style="color:black;">
    <h1 class="mb-4">Listado de Tipos de Atracción</h1>

    @if(session('message'))
        <script>
            Swal.fire({
                title: "CONFIRMACIÓN",
                text: "{{ session('message') }}",
                icon: "success",
            });
        </script>
    @endif

    <div class="mb-3">
        <a href="{{ route('tipoAtraccion.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Registrar tipo de atracción
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>NOMBRE DE TIPO DE ATRACCIÓN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipoAtracciones as $indice => $tipoTemporal)
                    <tr>
                        <td>{{ $indice + 1 }}</td>  
                        <td>{{ $tipoTemporal->nombre_at }}</td>
                        <td>
                            <a href="{{ route('tipoAtraccion.edit', $tipoTemporal->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('tipoAtraccion.destroy', $tipoTemporal->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm btn-eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-eliminar').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro de eliminar este tipo de atracción?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
</script>

@endsection
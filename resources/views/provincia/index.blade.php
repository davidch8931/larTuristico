@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4" style="color:black;">
    <h1 class="mb-4">Listado de Provincias</h1>

    @if(session('message'))
        <script>
            Swal.fire({
                title: "CONFIRMACIÓN",
                text: "{{ session('message') }}",
                icon: "success",
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: "ERROR",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif

    <div class="mb-3">
        <a href="{{ route('provincias.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Registrar provincia
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>NOMBRE DE PROVINCIA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provincias as $indice => $provinciaTemporal)
                    <tr>
                        <td>{{ $indice +1 }}</td>  
                        <td>{{ $provinciaTemporal->nombre_prov }}</td>
                        <td>
                            <a href="{{ route('provincias.edit', $provinciaTemporal->id_provincia) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('provincias.destroy', $provinciaTemporal->id_provincia) }}" method="POST" style="display:inline;" class="form-eliminar">
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
                    title: '¿Estás seguro de eliminar esta provincia?',
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
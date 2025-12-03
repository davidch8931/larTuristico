@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4" style="color:black;">
    <h1 class="mb-4">Listado de Lugares Turísticos</h1>

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
        <a href="{{ route('lugarTuristico.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Registrar lugar turístico
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>NOMBRE</th>
                    <th>COORDENADAS</th>
                    <th>DESCRIPCIÓN</th>
                    <th>AÑO</th>
                    <th>ACCESIBILIDAD</th>
                    <th>PROVINCIA</th>
                    <th>TIPO DE ATRACCIÓN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lugarTuristicos as $indice => $lugarTemporal)
                    <tr>
                        <td>{{ $indice +1 }}</td>  
                        <td>{{ $lugarTemporal->nombre }}</td>
                        <td>{{ $lugarTemporal->coordenadas }}</td>
                        <td>{{ $lugarTemporal->descripcion }}</td>
                        <td>{{ $lugarTemporal->anio }}</td>
                        <td>{{ $lugarTemporal->accesibilidad }}</td>
                        <td>{{ $lugarTemporal->provincia->nombre_prov ?? 'N/A' }}</td>
                        <td>{{ $lugarTemporal->tipoAtraccion->nombre_at ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('lugarTuristico.edit', $lugarTemporal->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('lugarTuristico.destroy', $lugarTemporal->id) }}" method="POST" style="display:inline;" class="form-eliminar">
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
                    title: '¿Estás seguro de eliminar este lugar turístico?',
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
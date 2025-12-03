@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4">Registrar Nuevo Lugar Turístico</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lugarTuristico.store') }}" method="POST" id="frm_lugar_turistico">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Lugar Turístico</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                   id="nombre" name="nombre" value="{{ old('nombre') }}">
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="latitud">Latitud</label>
                <input type="text" class="form-control" id="latitud" name="latitud" readonly placeholder="Seleccione en el mapa">
            </div>
            <div class="col-md-6">
                <label for="longitud">Longitud</label>
                <input type="text" class="form-control" id="longitud" name="longitud" readonly placeholder="Seleccione en el mapa">
            </div>
        </div>

        <div class="mb-3">
            <label>Seleccione la ubicación en el mapa</label>
            <div id="mapa" style="height:300px; width:100%; border:2px solid black;"></div>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="text" class="form-control" id="anio" name="anio">
        </div>

        <div class="mb-3">
            <label for="accesibilidad" class="form-label">Accesibilidad</label>
            <select class="form-control" id="accesibilidad" name="accesibilidad">
                <option value="Fácil" selected>Fácil</option>
                <option value="Medio">Medio</option>
                <option value="Difícil">Difícil</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fk_id_provincia" class="form-label">Provincia</label>
            <select class="form-control" id="fk_id_provincia" name="fk_id_provincia">
                <option value="">Seleccione una provincia</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nombre_prov }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fk_id_tipo" class="form-label">Tipo de Atracción</label>
            <select class="form-control" id="fk_id_tipo" name="fk_id_tipo">
                <option value="">Seleccione un tipo de atracción</option>
                @foreach($tipoAtracciones as $tipoAtraccion)
                    <option value="{{ $tipoAtraccion->id }}">{{ $tipoAtraccion->nombre_at }}</option>
                @endforeach
            </select>
        </div>
        
        <input type="hidden" id="coordenadas" name="coordenadas">
        
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar
        </button>
        <a href="{{ route('lugarTuristico.index') }}" class="btn btn-secondary">
            <i class="fa fa-times"></i> Cancelar
        </a>
    </form>
</div>

<script>
    $(document).ready(function() {
        $("#frm_lugar_turistico").validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                latitud: {
                    required: true
                },
                longitud: {
                    required: true
                },
                descripcion: {
                    required: true,
                    minlength: 10,
                    maxlength: 255
                },
                anio: {
                    required: true,
                    minlength: 4,
                    maxlength: 4,
                    digits: true,
                    step: 1,
                    min: 1400,
                    max: 2025
                },
                accesibilidad: {
                    required: true,
                },
                fk_id_provincia: {
                    required: true
                },
                fk_id_tipo: {
                    required: true
                }
            },
            messages: {
                nombre: {
                    required: "Por favor ingrese el nombre del lugar turístico",
                    minlength: "El nombre debe tener al menos 3 caracteres",
                    maxlength: "El nombre debe tener máximo 100 caracteres"
                },
                latitud: {
                    required: "Por favor seleccione la latitud en el mapa"
                },
                longitud: {
                    required: "Por favor seleccione la longitud en el mapa"
                },
                descripcion: {
                    required: "Por favor ingrese una descripción",
                    minlength: "La descripción debe tener al menos 10 caracteres",
                    maxlength: "La descripción debe tener máximo 255 caracteres"
                },
                anio: {
                    required: "Por favor ingrese el año",
                    minlength: "El año debe tener 4 dígitos y ser numeros enteros",
                    maxlength: "El año debe tener 4 dígitos y ser numeros enteros",
                    digits: "El año debe ser un número entero",
                    step: "El año debe ser un número entero",
                    min: "El año debe ser mayor o igual a 1400",
                    max: "El año debe ser menor o igual a 2025",
                    
                },
                accesibilidad: {
                    required: "Por favor ingrese el tipo de accesibilidad",
                },
                fk_id_provincia: {
                    required: "Por favor seleccione una provincia"
                },
                fk_id_tipo: {
                    required: "Por favor seleccione un tipo de atracción"
                }
            },
            
        });
    });
    
</script>
<script>
    function initMap() {
        // Coordenadas iniciales (Ecuador)
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);

        var mapa = new google.maps.Map(
            document.getElementById('mapa'),
            {
                center: latitud_longitud,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );

        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Seleccione la ubicación del lugar turístico",
            draggable: true
        });

        google.maps.event.addListener(
            marcador,
            'dragend',
            function(event) {
                var latitud = this.getPosition().lat();
                var longitud = this.getPosition().lng();
                document.getElementById("latitud").value = latitud;
                document.getElementById("longitud").value = longitud;
                document.getElementById("coordenadas").value = latitud + "," + longitud;
            }
        );

        // También permitir hacer clic en el mapa para establecer ubicación
        google.maps.event.addListener(
            mapa,
            'click',
            function(event) {
                var latitud = event.latLng.lat();
                var longitud = event.latLng.lng();
                marcador.setPosition(event.latLng);
                document.getElementById("latitud").value = latitud;
                document.getElementById("longitud").value = longitud;
                document.getElementById("coordenadas").value = latitud + "," + longitud;
            }
        );

        // Establecer valores iniciales
        document.getElementById("coordenadas").value = "-0.9374805,-78.6161327";
    }
    // Inicializar el mapa cuando la página cargue
    window.onload = function() {
        initMap();
    };
</script>
@endsection
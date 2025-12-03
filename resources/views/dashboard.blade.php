@extends('layout.plantilla')

@section('contenido')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Dashboard</h3>
                    <p class="text-muted">Bienvenido, {{ Auth::user()->name }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Provincias</h5>
                                    <p class="card-text">Administra las provincias</p>
                                    <a href="{{ route('provincias.index') }}" class="btn btn-light">Ir a Provincias</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Tipos de Atracción</h5>
                                    <p class="card-text">Administra los tipos de atracción</p>
                                    <a href="{{ route('tipoAtraccion.index') }}" class="btn btn-light">Ir a Tipos</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Lugares Turísticos</h5>
                                    <p class="card-text">Administra los lugares turísticos</p>
                                    <a href="{{ route('lugarTuristico.index') }}" class="btn btn-light">Ir a Lugares</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
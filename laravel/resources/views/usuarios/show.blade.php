@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mt-4 border-primary">
                <div class="card-header bg-primary bg-gradient text-white d-flex align-items-center">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    <h4 class="mb-0">Detalle de Usuario</h4>
                </div>
                <div class="card-body bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="{{ $usuario->foto_url }}" width="120" class="rounded-circle border border-3"/>
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-hash"></i> <strong>ID:</strong> {{ $usuario->id }}</li>
                                <li class="list-group-item"><i class="bi bi-person-fill"></i> <strong>Nombre:</strong> {{ $usuario->nombre }}</li>
                                <li class="list-group-item"><i class="bi bi-person-vcard-fill"></i> <strong>Apellido Paterno:</strong> {{ $usuario->apellido_paterno }}</li>
                                <li class="list-group-item"><i class="bi bi-person-vcard"></i> <strong>Apellido Materno:</strong> {{ $usuario->apellido_materno }}</li>
                                <li class="list-group-item"><i class="bi bi-calendar-date"></i> <strong>Fecha de Nacimiento:</strong> {{ $usuario->fecha_nacimiento }}</li>
                                <li class="list-group-item"><i class="bi bi-hourglass-split"></i> <strong>Edad:</strong> {{ $usuario->edad_completa }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

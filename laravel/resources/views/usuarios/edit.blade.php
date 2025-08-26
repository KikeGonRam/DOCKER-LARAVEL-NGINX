@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mt-4 border-primary">
                <div class="card-header bg-primary bg-gradient text-white d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i>
                    <h4 class="mb-0">Editar Usuario</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-fill"></i> Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-vcard-fill"></i> Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" value="{{ $usuario->apellido_paterno }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-vcard"></i> Apellido Materno</label>
                            <input type="text" name="apellido_materno" class="form-control" value="{{ $usuario->apellido_materno }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-calendar-date"></i> Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $usuario->fecha_nacimiento }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-image"></i> Foto</label>
                            <input type="file" name="foto" class="form-control">
                            <img src="{{ $usuario->foto_url }}" width="60" class="rounded-circle border border-2 mt-2"/>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Actualizar</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

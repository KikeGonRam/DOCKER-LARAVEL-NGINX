@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><i class="bi bi-people-fill"></i> Administración de Usuarios</h1>
        <div>
            <a href="{{ route('usuarios.graficas') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-bar-chart-fill"></i> Ver Gráficas
            </a>
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="bi bi-person-plus-fill"></i> Nuevo Usuario
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            {{-- Search Form --}}
            <form action="{{ route('usuarios.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o apellidos..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </form>

            {{-- Users Grid --}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($usuarios as $usuario)
                    <div class="col">
                        <div class="card h-100 text-center shadow-hover">
                            <div class="card-body">
                                <img src="{{ $usuario->foto_url ?: asset('images/default-user.png') }}" alt="Foto de {{ $usuario->nombre }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover;">
                                <h5 class="card-title">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</h5>
                                <p class="card-text text-muted">{{ $usuario->edad_completa }}</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-{{ $usuario->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i> Acciones
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $usuario->id }}">
                                        <li><a class="dropdown-item" href="{{ route('usuarios.show', $usuario) }}"><i class="bi bi-eye-fill text-info"></i> Ver Detalles</a></li>
                                        <li><a class="dropdown-item" href="{{ route('usuarios.edit', $usuario) }}"><i class="bi bi-pencil-square text-warning"></i> Editar</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash-fill"></i> Eliminar</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-exclamation-triangle-fill"></i> No se encontraron usuarios que coincidan con la búsqueda.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($usuarios->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    .shadow-hover {
        transition: box-shadow .3s ease-in-out;
    }
    .shadow-hover:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endpush
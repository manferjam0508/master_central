@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Todas las Reservas</h2>
    <a href="{{ route('reservas.create') }}" class="btn btn-success">
        ➕ Nueva Reserva
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('reservas.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="buscar_nombre" class="form-control" 
                       placeholder="Buscar por nombre..." 
                       value="{{ request('buscar_nombre') }}">
            </div>
            <div class="col-md-3">
                <select name="buscar_laboratorio" class="form-select">
                    <option value="">Todos los laboratorios</option>
                    @foreach($laboratorios as $lab)
                        <option value="{{ $lab->id }}" {{ request('buscar_laboratorio') == $lab->id ? 'selected' : '' }}>
                            {{ $lab->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="buscar_fecha" class="form-control" 
                       placeholder="Fecha solicitud"
                       value="{{ request('buscar_fecha') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
            </div>
        </form>
        @if(request()->hasAny(['buscar_nombre', 'buscar_laboratorio', 'buscar_fecha']))
            <div class="mt-2">
                <a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary btn-sm">Limpiar filtros</a>
            </div>
        @endif
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Laboratorio</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Dependencia</th>
                <th>Fecha Solicitud</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
            <tr>
                <td>{{ $reserva->id }}</td>
                <td>
                    <span class="badge bg-info">{{ $reserva->laboratory->nombre }}</span>
                </td>
                <td>{{ $reserva->nombre_usuario }}</td>
                <td>{{ $reserva->userType->nombre }}</td>
                <td>{{ $reserva->dependency->nombre }}</td>
                <td>{{ $reserva->fecha_solicitud->format('d/m/Y') }}</td>
                <td>{{ $reserva->fecha_hora_inicio->format('d/m/Y H:i') }}</td>
                <td>{{ $reserva->fecha_hora_fin->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-warning btn-sm">
                        ✏️ Editar
                    </a>
                    <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta reserva?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-muted">No hay reservas registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $reservas->links('pagination::bootstrap-5') }}
</div>

@endsection
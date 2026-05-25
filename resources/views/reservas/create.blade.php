@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">➕ Crear Nueva Reserva</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('reservas.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Laboratorio *</label>
                        <select name="laboratory_id" class="form-select @error('laboratory_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            @foreach($laboratorios as $lab)
                                <option value="{{ $lab->id }}" {{ old('laboratory_id') == $lab->id ? 'selected' : '' }}>
                                    {{ $lab->nombre }} (Capacidad: {{ $lab->capacidad }})
                                </option>
                            @endforeach
                        </select>
                        @error('laboratory_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre del Usuario *</label>
                            <input type="text" name="nombre_usuario" class="form-control @error('nombre_usuario') is-invalid @enderror" value="{{ old('nombre_usuario') }}" required>
                            @error('nombre_usuario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Identificacion *</label>
                            <input type="text" name="identificacion" class="form-control @error('identificacion') is-invalid @enderror" value="{{ old('identificacion') }}" required>
                            @error('identificacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Usuario *</label>
                            <select name="user_type_id" class="form-select @error('user_type_id') is-invalid @enderror" required>
                                <option value="">Seleccione...</option>
                                @foreach($tiposUsuario as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('user_type_id') == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dependencia/Programa *</label>
                            <select name="dependency_id" class="form-select @error('dependency_id') is-invalid @enderror" required>
                                <option value="">Seleccione...</option>
                                @foreach($dependencias as $dep)
                                    <option value="{{ $dep->id }}" {{ old('dependency_id') == $dep->id ? 'selected' : '' }}>
                                        {{ $dep->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dependency_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Solicitud *</label>
                        <input type="date" name="fecha_solicitud" class="form-control @error('fecha_solicitud') is-invalid @enderror" value="{{ old('fecha_solicitud', date('Y-m-d')) }}" required>
                        @error('fecha_solicitud')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha/Hora Inicio *</label>
                            <input type="datetime-local" name="fecha_hora_inicio" class="form-control @error('fecha_hora_inicio') is-invalid @enderror" value="{{ old('fecha_hora_inicio') }}" required>
                            @error('fecha_hora_inicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha/Hora Fin *</label>
                            <input type="datetime-local" name="fecha_hora_fin" class="form-control @error('fecha_hora_fin') is-invalid @enderror" value="{{ old('fecha_hora_fin') }}" required>
                            @error('fecha_hora_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" rows="3">{{ old('observaciones') }}</textarea>
                        @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Reserva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
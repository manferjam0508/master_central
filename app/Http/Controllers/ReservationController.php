<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Laboratory;
use App\Models\UserType;
use App\Models\Dependency;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['laboratory', 'userType', 'dependency'])
            ->orderBy('fecha_hora_inicio', 'desc');

        if ($request->filled('buscar_nombre')) {
            $query->where('nombre_usuario', 'like', '%' . $request->buscar_nombre . '%');
        }

        if ($request->filled('buscar_laboratorio')) {
            $query->where('laboratory_id', $request->buscar_laboratorio);
        }

        if ($request->filled('buscar_fecha')) {
            $query->whereDate('fecha_solicitud', $request->buscar_fecha);
        }

        $reservas = $query->paginate(5)->withQueryString();

        $laboratorios = Laboratory::all();

        return view('reservas.index', compact('reservas', 'laboratorios'));
    }

    public function create()
    {
        $laboratorios = Laboratory::all();
        $tiposUsuario = UserType::all();
        $dependencias = Dependency::all();

        return view('reservas.create', compact('laboratorios', 'tiposUsuario', 'dependencias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'user_type_id' => 'required|exists:user_types,id',
            'dependency_id' => 'required|exists:dependencies,id',
            'nombre_usuario' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50',
            'fecha_solicitud' => 'required|date',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
            'observaciones' => 'nullable|string',
        ]);

        if ($this->haySolapamiento($validated['laboratory_id'], $validated['fecha_hora_inicio'], $validated['fecha_hora_fin'])) {
            return back()->withInput()->withErrors(['fecha_hora_inicio' => 'Este laboratorio ya esta reservado en ese horario.']);
        }

        Reservation::create($validated);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva creada exitosamente.');
    }

    public function show(Reservation $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reservation $reserva)
    {
        $laboratorios = Laboratory::all();
        $tiposUsuario = UserType::all();
        $dependencias = Dependency::all();

        return view('reservas.edit', compact('reserva', 'laboratorios', 'tiposUsuario', 'dependencias'));
    }

    public function update(Request $request, Reservation $reserva)
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'user_type_id' => 'required|exists:user_types,id',
            'dependency_id' => 'required|exists:dependencies,id',
            'nombre_usuario' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50',
            'fecha_solicitud' => 'required|date',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
            'observaciones' => 'nullable|string',
        ]);

        if ($this->haySolapamiento($validated['laboratory_id'], $validated['fecha_hora_inicio'], $validated['fecha_hora_fin'], $reserva->id)) {
            return back()->withInput()->withErrors(['fecha_hora_inicio' => 'Este laboratorio ya esta reservado en ese horario.']);
        }

        $reserva->update($validated);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy(Reservation $reserva)
    {
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva eliminada exitosamente.');
    }

    private function haySolapamiento($labId, $inicio, $fin, $excluirId = null)
    {
        $query = Reservation::where('laboratory_id', $labId)
            ->where(function ($q) use ($inicio, $fin) {
                $q->whereBetween('fecha_hora_inicio', [$inicio, $fin])
                  ->orWhereBetween('fecha_hora_fin', [$inicio, $fin])
                  ->orWhere(function ($q2) use ($inicio, $fin) {
                      $q2->where('fecha_hora_inicio', '<=', $inicio)
                         ->where('fecha_hora_fin', '>=', $fin);
                  });
            });

        if ($excluirId) {
            $query->where('id', '!=', $excluirId);
        }

        return $query->exists();
    }
}
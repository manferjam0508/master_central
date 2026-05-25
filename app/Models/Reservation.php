<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'laboratory_id',
        'user_type_id',
        'dependency_id',
        'nombre_usuario',
        'identificacion',
        'fecha_solicitud',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'observaciones'
    ];

    protected $casts = [
        'fecha_solicitud' => 'date',
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime',
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    public function dependency(): BelongsTo
    {
        return $this->belongsTo(Dependency::class);
    }
}

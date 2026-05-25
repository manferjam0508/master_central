<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    protected $fillable = ['nombre', 'tipo', 'capacidad'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
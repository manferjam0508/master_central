<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    protected $fillable = ['nombre'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}

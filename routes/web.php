<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return redirect()->route('reservas.index');
});

Route::resource('reservas', ReservationController::class);

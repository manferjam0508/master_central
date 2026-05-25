<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use App\Models\Dependency;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Laboratorios
        Laboratory::create(['nombre' => 'Lab Fotografía', 'tipo' => 'fotografia', 'capacidad' => 20]);
        Laboratory::create(['nombre' => 'Lab Video', 'tipo' => 'video', 'capacidad' => 30]);
        Laboratory::create(['nombre' => 'Lab Sonido', 'tipo' => 'sonido', 'capacidad' => 25]);

        // Tipos de usuario
        UserType::create(['nombre' => 'Estudiante']);
        UserType::create(['nombre' => 'Docente']);
        UserType::create(['nombre' => 'Administrativo']);

        // Dependencias
        $deps = ['Ingeniería de Sistemas', 'Diseño Gráfico', 'Comunicación Social', 'Música', 'Cine y TV'];
        foreach ($deps as $dep) {
            Dependency::create(['nombre' => $dep]);
        }
    }
}
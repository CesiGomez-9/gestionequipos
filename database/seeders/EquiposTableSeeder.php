<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class EquiposTableSeeder extends Seeder
{
    public function run(): void
    {
        Equipo::factory(30)->create();
    }
}


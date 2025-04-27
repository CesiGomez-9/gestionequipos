<?php

namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;

class JugadoresTableSeeder extends Seeder
{
    public function run(): void
    {
        Jugador::factory(80)->create();
    }
}

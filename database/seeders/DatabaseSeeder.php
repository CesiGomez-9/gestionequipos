<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();

        $this->call(EquiposTableSeeder::class);
        $this->call(JugadoresTableSeeder::class);
    }
}

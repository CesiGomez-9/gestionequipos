<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'logo' => $this->faker->imageUrl(200, 200, 'sports', true, 'Equipo'),
            'pais' => $this->faker->country,
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}

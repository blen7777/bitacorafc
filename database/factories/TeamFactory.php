<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(), // Nombre del equipo
            'coach' => $this->faker->name(), // Nombre del entrenador
            'logo' => $this->faker->imageUrl(100, 100, 'sports', true, 'Team Logo'), // URL del logo
            'phone' => $this->faker->phoneNumber(), 
        ];
    }
}


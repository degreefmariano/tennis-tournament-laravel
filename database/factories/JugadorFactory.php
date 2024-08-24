<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jugador;
use App\Models\Torneo;

class JugadorFactory extends Factory
{
    protected $model = Jugador::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'habilidad' => $this->faker->numberBetween(0, 100),
            'fuerza' => $this->faker->optional()->numberBetween(0, 100),
            'velocidad' => $this->faker->optional()->numberBetween(0, 100),
            'tiempo_reaccion' => $this->faker->optional()->numberBetween(0, 100),
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'torneo_id' => Torneo::factory(),
        ];
    }
}


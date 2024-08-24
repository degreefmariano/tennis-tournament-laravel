<?php

namespace Database\Factories;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TorneoFactory extends Factory
{
    protected $model = Torneo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,  // Usa `word` para nombres aleatorios
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'fecha' => $this->faker->dateTimeThisYear(),  // Genera una fecha aleatoria
        ];
    }
}

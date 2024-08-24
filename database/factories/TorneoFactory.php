<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jugador;
use App\Models\Torneo;

class TorneoFactory extends Factory
{
    protected $model = Torneo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,  // Usa `word` para nombres aleatorios
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'fecha' => $this->faker->dateTimeThisYear()  // Genera una fecha aleatoria
        ];
    }
}

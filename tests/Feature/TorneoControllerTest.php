<?php

namespace Tests\Feature;

use App\Models\Torneo;
use App\Models\Jugador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TorneoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_crear_un_torneo_y_determinar_al_ganador()
    {
        // Creamos el torneo
        $data = [
            'nombre' => 'Torneo de prueba',
            'genero' => 'Masculino',
            'jugadores' => [
                [
                    'nombre' => 'Jugador 1',
                    'habilidad' => 80,
                    'fuerza' => 70,
                    'velocidad' => 60,
                    'tiempo_reaccion' => 50,
                    'genero' => 'Masculino',
                ],
                [
                    'nombre' => 'Jugador 2',
                    'habilidad' => 75,
                    'fuerza' => 65,
                    'velocidad' => 55,
                    'tiempo_reaccion' => 45,
                    'genero' => 'Masculino',
                ]
            ]
        ];

        // Llamamos a la API para crear el torneo
        $response = $this->postJson('/api/torneos', $data);

        // Verificamos que la respuesta fue exitosa
        $response->assertStatus(201);

        // Verificamos que el torneo fue creado en la base de datos
        $this->assertDatabaseHas('torneos', ['nombre' => 'Torneo de prueba']);

        // Verificamos que los jugadores fueron creados en la base de datos
        $this->assertDatabaseHas('jugadores', ['nombre' => 'Jugador 1']);
        $this->assertDatabaseHas('jugadores', ['nombre' => 'Jugador 2']);

        // Verificamos que hay un ganador
        $torneo = Torneo::where('nombre', 'Torneo de prueba')->first();
        $this->assertNotNull($torneo->ganador);
        $this->assertTrue(in_array($torneo->ganador, ['Jugador 1', 'Jugador 2']));

        // Verificamos que el torneo fue finalizado correctamente
        $this->assertEquals(Torneo::RESULTADO_F, $torneo->resultado);
    }
}

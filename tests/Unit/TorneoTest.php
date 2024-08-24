<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Jugador;
use App\Models\Torneo;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TorneoTest extends TestCase
{
    use DatabaseTransactions;

    public function testSimularTorneoMasculino()
    {
        $torneo = Torneo::factory()->create();
        $jugadores = Jugador::factory()->count(4)->make([
            'torneo_id' => $torneo->id
        ]);

        $ganador = Jugador::simularTorneo($jugadores, 'Masculino');

        $this->assertNotNull($ganador);
        $this->assertContains($ganador, $jugadores->pluck('nombre')->toArray());

    }
}

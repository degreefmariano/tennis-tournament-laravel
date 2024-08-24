<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
        'habilidad',
        'fuerza',
        'velocidad',
        'tiempo_reaccion',
        'genero',
        'suerte',
        'torneo_id'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public static function simularTorneo(Collection $jugadores, string $genero)
    {
        while ($jugadores->count() > 1) {
            $jugadores = self::jugarRonda($jugadores, $genero);
        }

        return $jugadores->first()->nombre;
    }

    protected static function jugarRonda(Collection $jugadores, string $genero): Collection
    {
        $ganadores = collect();

        while ($jugadores->count() > 1) {
            $jugador1 = $jugadores->shift();
            $jugador2 = $jugadores->shift();
            $ganador = self::determinarGanador($jugador1, $jugador2, $genero);
            $ganadores->push($ganador);
        }

        return $ganadores;
    }

    protected static function determinarGanador(Jugador $jugador1, Jugador $jugador2, string $genero): Jugador
    {
        $suerte1 = mt_rand(0, 10);
        $suerte2 = mt_rand(0, 10);
    
        $jugador1->suerte = $suerte1;
        $jugador2->suerte = $suerte2;
        $jugador1->save();
        $jugador2->save();
    
        $habilidad1 = $jugador1->habilidad + $suerte1;
        $habilidad2 = $jugador2->habilidad + $suerte2;
    
        if ($genero === 'Masculino') {
            $habilidad1 += $jugador1->fuerza + $jugador1->velocidad;
            $habilidad2 += $jugador2->fuerza + $jugador2->velocidad;
        } else {
            $habilidad1 += $jugador1->tiempo_reaccion;
            $habilidad2 += $jugador2->tiempo_reaccion;
        }
    
        return $habilidad1 > $habilidad2 ? $jugador1 : $jugador2;
    }
    
}

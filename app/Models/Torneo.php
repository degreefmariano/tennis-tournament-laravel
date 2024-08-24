<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;
    
    protected $table = 'torneos';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';

    public const RESULTADO_F = 'finalizado';
    public const RESULTADO_NF = 'no finalizado';

    protected $fillable = [
        'nombre',
        'fecha',
        'genero',
        'ganador',
        'resultado'
    ];

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }

}


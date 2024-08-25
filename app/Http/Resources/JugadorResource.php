<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JugadorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'habilidad' => $this->habilidad,
            'fuerza' => $this->fuerza,
            'velocidad' => $this->velocidad,
            'tiempo_reaccion' => $this->tiempo_reaccion,
            'genero' => $this->genero,
            'torneo_id' => $this->torneo_id,
        ];
    }
}

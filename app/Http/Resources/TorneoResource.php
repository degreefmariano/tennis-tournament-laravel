<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TorneoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'fecha' => Carbon::parse($this->fecha)->format('d/m/Y'),
            'genero' => $this->genero,
            'ganador' => $this->ganador,
            'resultado' => $this->resultado,
            'jugadores' => JugadorResource::collection($this->whenLoaded('jugadores'))
        ];
    }
}

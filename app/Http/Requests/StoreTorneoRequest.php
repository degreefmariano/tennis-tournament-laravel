<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTorneoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'genero' => 'required|in:Masculino,Femenino',
            'jugadores.*.nombre' => 'required|string|max:255',
            'jugadores.*.habilidad' => 'required|integer|between:0,100',
            'jugadores.*.fuerza' => 'required|integer|between:0,100',
            'jugadores.*.velocidad' => 'required|integer|between:0,100',
            'jugadores.*.tiempo_reaccion' => 'required_if:genero,Femenino|integer|between:0,100',
            'jugadores.*.genero' => 'required|in:Masculino,Femenino',
            'jugadores.*.torneo_id' => 'required|integer',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $jugadores = $this->input('jugadores');
            $generoTorneo = $this->input('genero');
            foreach ($jugadores as $index => $jugador) {
                if ($generoTorneo === 'Masculino') {
                    if ($jugador['genero'] !== 'Masculino') {
                        $validator->errors()->add("jugadores.{$index}.genero", 'El género del jugador debe ser Masculino cuando el torneo es Masculino.');
                    }
                } elseif ($generoTorneo === 'Femenino') {
                    if ($jugador['genero'] !== 'Femenino') {
                        $validator->errors()->add("jugadores.{$index}.genero", 'El género del jugador debe ser Femenino cuando el torneo es Femenino.');
                    }
                }
            }

            $count = count($jugadores);

            if (! $this->isPowerOfTwo($count)) {
                $validator->errors()->add('jugadores', 'La cantidad de jugadores debe ser una potencia de 2.');
            }
        });
    }

    private function isPowerOfTwo($number)
    {
        return ($number > 0) && (($number & ($number - 1)) === 0);
    }

    public function messages()
    {
        return [
            'jugadores.*.tiempo_reaccion.required_if' => 'El campo tiempo de reacción es obligatorio para jugadores Femeninos.',
        ];
    }
}

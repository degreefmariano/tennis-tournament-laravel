<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class IndexTorneoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => ['sometimes', Rule::exists('torneos','nombre')],
            'fecha' => ['nullable', 'date_format:d-m-Y'],
            'genero' => ['sometimes', Rule::exists('torneos','genero')],
            'resultado' => ['sometimes', Rule::exists('torneos','resultado')],
        ];
    }   

    public function messages()
    {
        return [
            'nombre.exists'   => "Nombre de torneo inexistente",
            'genero.exists'   => "El género del torneo debe ser Masculino ó Femenino",
            'resultado.exists' => "El resultado del torneo debe ser Finalizado ó No Finalizado",
        ];
    }
}

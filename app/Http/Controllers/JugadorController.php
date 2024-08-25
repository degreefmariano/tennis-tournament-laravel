<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugadorRequest;
use App\Models\Jugador;
use App\Models\Torneo;

class JugadorController extends Controller
{
    public function store(StoreJugadorRequest $request)
    {
        $torneo = Jugador::create($request->validated());

        return response()->json($torneo, 201);
    }

    public function index()
    {
        $torneos = Torneo::all();

        return response()->json($torneos);
    }

    public function show(Torneo $torneo)
    {
        return response()->json($torneo);
    }

    public function simular(Torneo $torneo)
    {
        $jugadores = Jugador::where('torneo_id', $torneo->id)->get();
        $ganador = Jugador::simularTorneo($jugadores, $torneo->tipo);

        return response()->json(['ganador' => $ganador]);
    }
}

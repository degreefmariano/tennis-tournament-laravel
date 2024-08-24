<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTorneoRequest;
use App\Http\Requests\StoreTorneoRequest;
use App\Http\Resources\TorneoResource;
use App\Http\Resources\TorneosResource;
use App\Models\Jugador;
use App\Models\Torneo;
use Carbon\Carbon;

class TorneoController extends Controller
{
    public function store(StoreTorneoRequest $request)
    {
        $torneo = Torneo::create([
            'nombre' => $request->nombre,
            'genero' => $request->genero,
            'fecha' => Carbon::now(),
        ]);

        $jugadores = $request->jugadores;

        if (is_array($jugadores)) {
            foreach ($jugadores as $jugador) {
                Jugador::create([
                    'nombre' => $jugador['nombre'],
                    'habilidad' => $jugador['habilidad'],
                    'fuerza' => $jugador['fuerza'] ?? null,
                    'velocidad' => $jugador['velocidad'] ?? null,
                    'tiempo_reaccion' => $jugador['tiempo_reaccion'] ?? null,
                    'genero' => $jugador['genero'],
                    'torneo_id' => $torneo->id,
                ]);
            }
        }

        $jugadores = Jugador::where('torneo_id', $torneo->id)->get();
        $ganador = Jugador::simularTorneo($jugadores, $torneo->genero);

        if ($ganador) {
            $resultado = Torneo::RESULTADO_F;
        } else {
            $resultado = Torneo::RESULTADO_NF;
        }

        $torneo->update([
            'ganador' => $ganador,
            'resultado' => $resultado,
        ]);

        $torneo->load('jugadores');

        return response()->json([
            'message' => 'Torneo generado exitosamente',
            'data' => new TorneoResource($torneo)], 201);
    }

    public function index(IndexTorneoRequest $request)
    {
        $torneo = Torneo::query();

        $fechaInputIngles = Carbon::parse($request->input('fecha'))->format('Y-m-d');

        if ($request->has('nombre')) {
            $torneo->where('nombre', $request->input('nombre'));
        }

        if ($request->has('fecha')) {
            $torneo->whereDate('fecha', $fechaInputIngles);
        }

        if ($request->has('genero')) {
            $torneo->where('genero', $request->input('genero'));
        }

        if ($request->has('resultado')) {
            $torneo->where('resultado', $request->input('resultado'));
        }

        $torneos = $torneo->get();

        return response()->json([
            'message' => 'Consulta de torneos generada exitosamente',
            'data' => TorneosResource::collection($torneos)], 200);
    }

    public function show($id)
    {
        $torneo = Torneo::find($id);

        if (! $torneo) {
            return response()->json(['message' => 'Torneo no encontrado'], 404);
        }

        return response()->json([
            'message' => 'Torneo consultado exitosamente',
            'data' => new TorneoResource($torneo)], 200);
    }
}

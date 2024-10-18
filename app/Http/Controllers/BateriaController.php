<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bateria;
use App\Models\Surfista;

class BateriaController extends Controller
{
    //Armazena uma nova bateria.
    public function store(Request $request)
    {
        // Valida os dados recebidos do request
        $validated = $request->validate([
            'surfista1_id' => 'required|exists:surfistas,id',
            'surfista2_id' => 'required|exists:surfistas,id',
        ]);

        // Cria uma nova bateria usando os IDs dos surfistas
        $bateria = new Bateria;
        $bateria->surfista1_id = $validated['surfista1_id'];
        $bateria->surfista2_id = $validated['surfista2_id'];
        $bateria->save();

        return response()->json($bateria, 201);  // Retorna a bateria criada com status 201 (Criado)
    }
}

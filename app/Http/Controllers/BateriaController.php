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

    public function index()
    {
        $baterias = Bateria::all();
        return response()->json($baterias);
    }

    public function show($id)
    {
        $bateria = Bateria::find($id);
        if ($bateria) {
            return response()->json($bateria);
        } else {
            return response()->json(['message' => 'Bateria não encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $bateria = Bateria::find($id);

        if ($bateria) {
            // Valida os dados da requisição
            $request->validate([
                'nome' => 'string|max:255',
                'pais' => 'string|max:255',
            ]);
            if ($request->has('bateria1_id')) {
                $bateria->bateria1_id = $request->input('bateria1_id');
            }
            if ($request->has('bateria2_id')) {
                $bateria->bateria2_id = $request->input('bateria2_id');
            }
            $bateria->save(); //Salva as alterações

            return response()->json($bateria);
        } else {
            return response()->json(['message' => 'Bateria não encontrada'], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $bateria = Bateria::find($id);
        if ($bateria) {
            $bateria->delete();
            return response()->json(['message' => 'Bateria deletada com sucesso']);
        } else {
            return response()->json(['message' => 'Bateria não encontrada']);
        }
    }
}

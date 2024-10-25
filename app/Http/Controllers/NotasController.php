<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotasController extends Controller
{
    //Save
    public function store(Request $request)
    {
        $validated = $request->validate([
            'onda_id' => 'required|exists:ondas,id',
            'notaParcial1' => 'required|numeric|min:0|max:10', // Valida que é um número entre 0 e 10
            'notaParcial2' => 'required|numeric|min:0|max:10',
            'notaParcial3' => 'required|numeric|min:0|max:10',
        ]);

        $nota = new Nota;
        $nota->onda_id = $validated['onda_id'];
        $nota->notaParcial1 = $validated['notaParcial1'];
        $nota->notaParcial2 = $validated['notaParcial2'];
        $nota->notaParcial3 = $validated['notaParcial3'];
        $nota->save();

        return response()->json($nota, 201);
    }

    //Get All
    public function index()
    {
        $notas = Nota::all();

        return response()->json($notas);
    }

    //Find One
    public function show($id)
    {
        $nota = Nota::find($id);

        if ($nota) {
            return response()->json($nota);
        } else {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $nota = Nota::find($id);

        if ($nota) {
            $request->validate([
                'onda_id' => 'required|exists:ondas,id',
                'notaParcial1' => 'required|numeric|min:0|max:10', // Valida que é um número entre 0 e 10
                'notaParcial2' => 'required|numeric|min:0|max:10',
                'notaParcial3' => 'required|numeric|min:0|max:10',
            ]);

            if ($request->has('onda_id')) {
                $nota->onda_id = $request->input('onda_id');
            }
            if ($request->has('notaParcial1')) {
                $nota->notaParcial1 = $request->input('notaParcial1');
            }
            if ($request->has('notaParcial2')) {
                $nota->notaParcial2 = $request->input('notaParcial2');
            }
            if ($request->has('notaParcial3')) {
                $nota->notaParcial3 = $request->input('notaParcial3');
            }

            $nota->save();
            return response()->json($nota);
        } else {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }
    }

    public function destroy($id){
        $nota = Nota::find($id);

        if($nota){
            $nota->delete();

            return response()->json(['message' => 'Nota deletada com sucesso']);
        }else{
            return response()->json(['message' => 'Nota não encontrada']);
        }
    }
}

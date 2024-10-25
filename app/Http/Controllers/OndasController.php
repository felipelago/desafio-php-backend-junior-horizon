<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Onda;

class OndasController extends Controller
{
    //Save
    public function store(Request $request)
    {

        $validated = $request->validate([
            'bateria_id' => 'required|exists:baterias,id',
            'surfista_id' => 'required|exists:baterias,id',
        ]);

        $onda = new Onda;
        $onda->bateria_id = $validated['bateria_id'];
        $onda->surfista_id = $validated['surfista_id'];

        $onda->save();
        status:
        return response()->json($onda, 201);

    }

    //GetAll
    public function index()
    {
        $ondas = Onda::all();

        return response()->json($ondas);
    }

    //Update
    public function update(Request $request, $id)
    {
        $onda = Onda::find($id);

        if ($onda) {
            $request->validate([
                'bateria_id' => 'required|exists:baterias,id',
                'surfista_id' => 'required|exists:surfistas,id'
            ]);

            if ($request->has('bateria_id')) {
                $onda->bateria_id = $request->input('bateria_id');
            }
            if ($request->has('surfista_id')) {
                $onda->surfista_id = $request->input('surfista_id');
            }

            $onda->save();

            return response()->json($onda);
        } else {
            return response()->json(['mensagem' => 'Onda não encontrada', 404]);
        }
    }

    //Delete
    public function destroy($id)
    {
        $onda = Onda::find($id);

        if ($onda) {
            $onda->delete();
            return response()->json(['message' => 'Onda deletada com sucesso']);
        } else {
            return response()->json(['message' => 'Onda não encontrada', 404]);
        }

    }

}

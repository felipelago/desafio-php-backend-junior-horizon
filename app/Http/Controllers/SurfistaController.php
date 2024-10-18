<?php

namespace App\Http\Controllers;

use App\Models\Surfista;  // Importa o model Surfista
use Illuminate\Http\Request;

class SurfistaController extends Controller
{
    // Método para criar um novo surfista (POST)
    public function store(Request $request)
    {
        // Valida os dados da requisição
        $request->validate([
            'nome' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);

        // Cria uma nova instância do modelo Surfista e preenche os dados
        $surfista = new Surfista;
        $surfista->nome = $request->input('nome');
        $surfista->pais = $request->input('pais');
        $surfista->save(); // Salva no banco de dados

        // Retorna a resposta em JSON com status 201 (Created)
        return response()->json($surfista, 201);
    }

    // Método para listar todos os surfistas (GET)
    public function index()
    {
        // Obtém todos os surfistas do banco de dados
        $surfistas = Surfista::all();

        // Retorna os surfistas como JSON
        return response()->json($surfistas);
    }

    // Método para exibir um surfista específico (GET)
    public function show($id)
    {
        // Procura o surfista pelo ID
        $surfista = Surfista::find($id);

        // Verifica se o surfista existe
        if ($surfista) {
            return response()->json($surfista);
        } else {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }
    }

    // Método para atualizar um surfista existente (PUT ou PATCH)
    public function update(Request $request, $id)
    {
        // Procura o surfista pelo ID
        $surfista = Surfista::find($id);

        if ($surfista) {
            // Valida os dados da requisição
            $request->validate([
                'nome' => 'string|max:255',
                'pais' => 'string|max:255',
            ]);

            // Atualiza os dados
            if ($request->has('nome')) {
                $surfista->nome = $request->input('nome');
            }
            if ($request->has('pais')) {
                $surfista->pais = $request->input('pais');
            }
            
            $surfista->save(); // Salva as alterações

            // Retorna o surfista atualizado
            return response()->json($surfista);
        } else {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }
    }

    // Método para deletar um surfista (DELETE)
    public function destroy($id)
    {
        // Procura o surfista pelo ID
        $surfista = Surfista::find($id);

        if ($surfista) {
            $surfista->delete(); // Deleta o surfista

            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Surfista deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }
    }
}

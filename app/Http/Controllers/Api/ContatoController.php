<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        return response()->json(Contato::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:contatos,email',
        ]);

        $contato = Contato::create($request->all());

        return response()->json($contato, 201);
    }

    public function show($id)
    {
        $contato = Contato::find($id);
        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        return response()->json($contato, 200);
    }

    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);
        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        $contato->update($request->all());

        return response()->json($contato, 200);
    }

    public function destroy($id)
    {
        $contato = Contato::find($id);
        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        $contato->delete();

        return response()->json(['message' => 'Contato removido com sucesso'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Papel;
class PapelController extends Controller
{
    public function getAllPapel(Request $request)
    {
        $papel = Papel::all();
        return $papel;
    }

    public function createPapel(Request $request)
    {
        $nome = $request->input('nome');
        $gestor = $request->input('gestor');

        if(isset($nome) && isset($gestor))
        {
            $papel = Papel::create([
                'nome' => $nome,
                'gestor' => $gestor,
            ]);

            if(isset($papel))
            {
                return response()->json(['message' => 'Criado com sucesso.']);
            }
            else
            {
                return response()->json(['message' => 'Erro.']);
            }
        }
        else
        {
            return response()->json(['message' => 'Faltando Parametros.']);
        }

    }
}

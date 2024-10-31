<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Pessoa;
class VendaController extends Controller
{
    public function getAllVendas()
    {
        $vendas = Venda::with(["vendedor"])->get();
        return $vendas;
    }

    public function getAllVendasByPessoa(Request $request)
    {
        $pessoa = $request->input('pessoa');
        $vendas = Venda::with(["vendedor"])
        ->whereRelation("vendedor", "id", "=", $pessoa)->get();
        return $vendas;
    }


    public function createVenda(Request $request)
    {
        $pessoa = $request->input('pessoa');
        $valor = $request->input('valor');

        if(isset($pessoa) && isset($valor))
        {
            $find_pessoa = Pessoa::find($pessoa);
            if($find_pessoa)
            {
                $venda = Venda::create([
                    'pessoa' => $pessoa,
                    'valor' => $valor,
                ]);

                if($venda)
                {
                    return response()->json(['message' => 'Venda criada com sucesso.']);
                }
                else
                {
                    return response()->json(['message' => 'Erro']);
                }
            }
            else
            {
                return response()->json(['message' => 'Pessoa não cadastrada para vincular a venda']);
            }
        }
        else{
            return response()->json(['message' => 'Parametros incorretos']);
        }
    }

    public function deleteVenda(Request $request)
    {
        $id = $request->input('id');

        $venda = Venda::find($id);

        if($venda)
        {
            $venda->delete();
            return response()->json(['message' => 'Venda deletada com sucesso.']);
        }
        else
        {
            return response()->json(['message' => 'Venda não encontrada.'], 404);
        }
    }
}

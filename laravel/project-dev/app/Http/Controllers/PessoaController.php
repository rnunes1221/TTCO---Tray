<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\PapelPessoa;
use Illuminate\Support\Facades\DB;
class PessoaController extends Controller
{
    public function getAllPessoa(Request $request)
    {
        $pessoa = Pessoa::all();
        return $pessoa;
    }
    public function createPessoa(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $papel = $request->input('papel');

        if(isset($nome) && isset($email) && isset($papel))
        {
            try{
                DB::beginTransaction();
                $pessoa = Pessoa::create([
                    'nome' => $nome,
                    'email' => $email,
                ]);

                if($pessoa)
                {
                    PapelPessoa::create([
                        'papel' => $papel,
                        'pessoa' => $pessoa->id
                    ]);
                    DB::commit();
                }

                if(isset($pessoa))
                {
                    return response()->json(['message' => 'Criado com sucesso.']);
                }
                else
                {
                    return response()->json(['message' => 'Erro.']);
                }
            }
            catch (Exception $e)
            {
                DB::rollback();
            }
        }
        else
        {
            return response()->json(['message' => 'Faltando Parametros.']);
        }

    }

    public function editPessoa(Request $request)
    {
        $id = $request->input('id');
        $nome = $request->input('nome');
        $email = $request->input('email');
        if(isset($id) && isset($nome) && isset($email))
        {
            $pessoa = Pessoa::where('id', $id)->update([
                'nome' => $nome,
                'email' => $email,
            ]);

            if(isset($pessoa))
            {
                return response()->json(['message' => 'Alterado com sucesso.']);
            }
            else
            {
                return response()->json(['message' => 'Erro.']);
            }
        }
        else
        {
            return response()->json(['message' => 'Faltando Parametros']);
        }
    }

    public function deletePessoa(Request $request)
    {
        $id = $request->input('id');
        if(isset($id))
        {
            $pessoa = Pessoa::destroy($id);
            if(isset($pessoa))
            {
                return response()->json(['message' => 'Deletado com sucesso.']);
            }
            else
            {
                return response()->json(['message' => 'Erro.']);
            }
        }
        else
        {
            return response()->json(['message' => 'Faltando Parametros']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PapelPessoa;
class PapelPessoaController extends Controller
{
    public function getAllPessoaByPapel(Request $request)
    {
        $papel = $request->input('papel');
        $papelpessoa = PapelPessoa::with(["papeis","pessoas"])
        ->whereRelation("papeis", "id", "=", $papel)->get();
        return $papelpessoa;
    }
}

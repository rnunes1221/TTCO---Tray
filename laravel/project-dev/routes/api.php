<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PapelController;
use App\Http\Controllers\PapelPessoaController;
use App\Http\Controllers\VendaController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/pessoa/createPessoa', [PessoaController::class, 'createPessoa']);
Route::post('/pessoa/editPessoa', [PessoaController::class, 'editPessoa']);
Route::post('/pessoa/deletePessoa', [PessoaController::class, 'deletePessoa']);
Route::get('/pessoa/getAllPessoa', [PessoaController::class, 'getAllPessoa']);

Route::get('/papel/getAllPapel', [PapelController::class, 'getAllPapel']);
Route::post('/papel/createPapel', [PapelController::class, 'createPapel']);

Route::post('/papelpessoa/getAllPessoaByPapel', [PapelPessoaController::class, 'getAllPessoaByPapel']);


Route::get('/venda/getAllVendas', [VendaController::class, 'getAllVendas']);
Route::post('/venda/getAllVendasByPessoa', [VendaController::class, 'getAllVendasByPessoa']);
Route::post('/venda/createVenda', [VendaController::class, 'createVenda']);
Route::post('/venda/deleteVenda', [VendaController::class, 'deleteVenda']);

<?php

namespace App\Models;
use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'ttcm_vendas';
    protected $fillable = [
        'pessoa',
        'valor'
    ];
    public $timestamps = false;

    public function vendedor()
    {
        return $this->hasMany(Pessoa::class, "id","pessoa");
    }
}

<?php

namespace App\Models;
use App\Models\Pessoa;
use App\Models\Papel;
use Illuminate\Database\Eloquent\Model;

class PapelPessoa extends Model
{
    protected $table = 'ttcp_papel_pessoa';
    protected $fillable = [
        'papel',
        'pessoa'
    ];

    public $timestamps = false;

    public function papeis()
    {
        return $this->hasMany(Papel::class, "id","papel");
    }

    public function pessoas()
    {
        return $this->hasMany(Pessoa::class, "id","pessoa");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Papel extends Model
{
    use HasFactory;
    protected $table = 'ttcp_papel';
    protected $fillable = [
        'nome',
        'gestor'
    ];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comissao extends Model
{
    protected $fillable = [
        'comissao',
        'pessoa',
    ];
}

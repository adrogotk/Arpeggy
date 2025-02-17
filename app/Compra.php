<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';

    protected $fillable = [
        'user_id',
        'cancion_id',
        'numeroCuenta',
    ];
}

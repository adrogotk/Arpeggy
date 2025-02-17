<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista_reproduccion extends Model
{
    protected $table = 'lista_reproduccion';

    protected $fillable = [
        'id',
        'user_id',
        'nombre',
    ];
}

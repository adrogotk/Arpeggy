<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Canciones_lista extends Model
{
    protected $table = 'canciones_lista';

    protected $fillable = [
        'lista_id',
        'cancion_id',
    ];
}

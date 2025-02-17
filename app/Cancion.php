<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    protected $table = 'cancion';

    protected $fillable = [
        'id',
        'disco_id',
        'numeroCancion',
        'titulo',
        'url',
        'artistaColaborador_id',
        'artistaColaborador2_id',
    ];
}
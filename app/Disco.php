<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Disco extends Model
{
    protected $table = 'disco';

    protected $fillable = [
        'id',
        'artista_id',
        'titulo',
        'urlImagen',
    ];
}

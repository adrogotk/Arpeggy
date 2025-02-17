<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $table = 'artista';

    protected $fillable = [
        'id',
        'idUsuario',
        'nombre',
        'urlImagen',
        'biografia',
    ];
}
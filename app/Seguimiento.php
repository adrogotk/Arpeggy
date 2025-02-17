<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimiento';

    protected $fillable = [
        'user_id',
        'artista_id',
    ];
}

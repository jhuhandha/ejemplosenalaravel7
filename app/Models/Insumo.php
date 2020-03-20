<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumo';

    protected $fillable = ['nombre', 'cantidad', 'precio'];

    public $timestamps = false;
}

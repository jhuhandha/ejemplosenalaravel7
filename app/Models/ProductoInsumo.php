<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoInsumo extends Model
{
    protected $table = 'producto_insumo';

    protected $fillable = ['producto_id', 'insumo_id', 'cantidad'];

    public $timestamps = false;
}

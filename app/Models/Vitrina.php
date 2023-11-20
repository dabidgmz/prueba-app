<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitrina extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'empresa_id',
    ];

}


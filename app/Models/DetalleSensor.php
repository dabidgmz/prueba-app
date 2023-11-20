<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSensor extends Model
{
    protected $fillable = [
        'vitrina_id', 
        'sensor_id', 
        'valor_sensor', 
        'fecha_hora'];
}

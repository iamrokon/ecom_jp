<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $table = 'kokyaku1';
    protected $primaryKey = 'bango';
    
    protected $visible = [
        'bango', 'name', 'mallsoukobango1', 'point1', 'point2', 'souryougenkai', 'souryou0', 'souryou1', 'souryou2', 'mallsoukobango2', 'yobi13'
    ];

}
 
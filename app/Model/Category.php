<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'bango';
    protected $table = 'categorykanri';
    public $timestamps = false;
}

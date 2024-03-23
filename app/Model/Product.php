<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'syouhin1';
    protected $primaryKey = 'bango';
    public $timestamps = false;

    public function product2()
    {
        return $this->hasOne('App\Model\Product2','bango','bango');
    }
    public function product3()
    {
        return $this->hasOne('App\Model\Product3','bango','bango');
    }
    public function gazou()
    {
        return $this->hasOne('App\Model\Gazou','syouhinbango','bango');
    }
    public function parent_category()
    {
        return $this->belongsTo('App\Model\Category','name','bango');
    }
    public function child_category()
    {
        return $this->belongsTo('App\Model\Category','tokuchou','bango');
    }
    public function brand()
    {
        return $this->belongsTo('App\Model\Category','mdjouhou','bango');
    }
}

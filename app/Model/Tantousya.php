<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tantousya extends Model
{
    protected $table = 'tantousya';
	protected $primaryKey = 'bango';
	public $incrementing = false;
	public $timestamps = false;

	public function is_locked()
	{
		if($this->accesscode=='3') return true;
		else return false;
	}
}

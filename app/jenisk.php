<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class jenisk extends Model
{
	protected $table = 'jenis_kendaraan';

	public function sys()
	{
		return $this->hasOne('App\sys');
	}
}

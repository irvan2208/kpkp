<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class users extends Model
{
	use SoftDeletes;
	protected $primaryKey = 'npm';
	//protected $dates = ['deleted_at'];
	protected $table = 'users';

	public function kendaraan()
	{
		return $this->hasMany('App\sys','npm');
	}

	public function prodi()
	{
		return $this->hasOne('App\prodi','id');
	}

    //public $timestamps = false; // kolom created_at updated_add tidak ada

    //protected $fillable = ['title','description']; //whitelist
    // protected $guarded = ['title','description']; //blacklist

}

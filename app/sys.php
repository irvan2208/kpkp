<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class sys extends Model
{
	use SoftDeletes;
	protected $primaryKey = 'no_polis';
	protected $dates = ['deleted_at'];
	protected $table = 'sys';
    //public $timestamps = false; // kolom created_at updated_add tidak ada

    //protected $fillable = ['title','description']; //whitelist
    // protected $guarded = ['title','description']; //blacklist

    public function user()
	{
		return $this->belongsTo('App\users','npm');
	}

	public function jenisk()
	{
		return $this->belongsTo('App\jenisk','jenis')->select(array('id', 'nama'));
	}
}

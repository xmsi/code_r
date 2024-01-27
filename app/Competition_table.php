<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition_table extends Model
{
	protected $primaryKey = null;
	public $timestamps = false;
	public $incrementing = false;
	protected $fillable = [
		'competition_id', 'doctor_id', 'rank'
	];

	public function competition()
	{
		return $this->belongsTo('App\Competition')->withPivot('doctor_id');
	}

	public function doctor()
	{
		return $this->belongsTo('App\Doctor');
	}
}

<?php

namespace App;

class Competition extends Common
{
	protected $fillable = [
		'title', 'description', 'images', 'workshop_id'
	];
	
	public function workshop()
	{
		return $this->belongsTo('App\Workshop');
	}

	public function competition_table()
	{
		return $this->hasMany('App\Competition_table');
	}
}

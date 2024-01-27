<?php

namespace App;

class Workshop extends Common
{
	protected $fillable = [
		'title', 'description', 'images', 'video', 'comments'
	];
	
	public function competition()
	{
		return $this->hasOne('App\Competition');
	}

	public function competition_table()
	{
		return $this->belongsToMany('App\Competition_table', 'competitions', 'workshop_id', 'id', 'id', 'competition_id');
	}
}

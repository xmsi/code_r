<?php

namespace App;

class Interconf extends Common
{
	protected $fillable = [
		'title', 'description', 'place', 'image', 'link', 'start_date', 'end_date'
	];

	protected $table = 'interconf';

	public function getStartDatenAttribute()
	{
		return date('d.m.Y', strtotime($this->start_date));
	}

	public function getEndDatenAttribute()
	{
		return date('d.m.Y', strtotime($this->end_date));
	}
}

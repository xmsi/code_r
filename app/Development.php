<?php

namespace App;

class Development extends Common
{
	protected $fillable = [
		'title', 'description', 'images'
	];

	protected $table = 'development';
	
}
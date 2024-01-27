<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
	protected $table = 'news';

	public $timestamps = false;

	protected $fillable = [
		'title', 'text', 'image', 'date'
	];

	public function getCuttedDescAttribute()
	{
		return Str::words($this->text, '25');
	}
}

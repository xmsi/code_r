<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Smi extends Model
{
	public $timestamps = false;

	protected $table = 'smi';

	protected $fillable = [
		'title', 'text', 'image', 'video', 'url'
	];

	public function getCuttedDescAttribute()
	{
		return Str::words($this->text, '25');
	}
}

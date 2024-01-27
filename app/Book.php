<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'title', 'category', 'author','description', 'image', 'file'
	];

	public function getCategorynAttribute()
	{
		$catn = '';
		if ($this->category == 0) {
			$catn = 'Книга';
		} elseif ($this->category == 1) {
			$catn = 'Рекомендация';
		}

		return $catn;
	}
}

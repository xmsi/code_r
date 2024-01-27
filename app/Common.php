<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Common extends Model
{
	public $timestamps = false;

	public function getCuttedDescAttribute()
	{
		return Str::words($this->description, '25');
	}

	public function getFrontDescAttribute()
	{
		return Str::words($this->description, '45');
	}

	public function getImagesAllAttribute()
	{
		$photos = explode(';', $this->images);
		if ($photos) {
			if (end($photos) == "")
				array_pop($photos);

			return $photos;			 
		}

		return null;
	}

}

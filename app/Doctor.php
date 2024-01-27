<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	public $timestamps = false;

	public function competition_table()
	{
		return $this->hasMany('App\Competition_table');
	}

	public function getNiceNameAttribute()
	{
		$niceName = explode(' ', $this->name);

		$name = $niceName[0] . "<br>" . $niceName[1] . "<br>" . $niceName[2];

		return $name;
	}

	public function animation($key)
	{
		$speed = '';
		switch ($key) {
			case 0:
				$speed = '1s';
				break;
			case 1:
				$speed = '1.3s';		
				break;
			case 2:
				$speed = '1.6s';
				break;
			case 3:
				$speed = '1.9s';
				break;
		}

		return $speed;
	}
}

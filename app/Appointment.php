<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'name', 'age', 'doctor_id', 'description', 'date', 'phone'
	];

	public function doctor()
	{
		return $this->belongsTo('App\Doctor');
	}

	public function getCuttedDescAttribute()
	{
		return Str::words($this->description, '25');
	}

	public function sendToTg(){
		$message = "\nИмя: ".$this->name."\nНомер: ". $this->phone."\nДата: ".$this->date."\nВозраст: ".$this->age."\nДоктор:  ". $this->doctor->name. "\nСообщение: " . $this->description;
        $apiToken = "1450036292:AAFPwpCiQ_GYSRstBe4Mw4HBkRJIlmRA3CI";
        $data = [
            'chat_id' => '-1001159883547',
            'text' => $message
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

        if ($response) {
            return true;
        }
	}
}

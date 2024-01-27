<?php

namespace App;

class VideoBlog extends Common
{
	protected $fillable = [
		'title', 'title_uz', 'description', 'description_uz', 'image', 'link', 'link_uz', 'comments'
	];

	protected $table = 'videoblog';
}

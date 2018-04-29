<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $fillable = [
		'name',
    	'genre_id',
    	'price',
    	'release',
    	'picture',
    ];
}

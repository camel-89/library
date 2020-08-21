<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	protected $fillable = ['title', 'year', 'reting', 'author_id'];

	public function author()
	{
		return $this->belongsTo('App\Author');
	}

}

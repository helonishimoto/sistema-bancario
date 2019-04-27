<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'value',
    ];

    public function user()
	{
    	return $this->belongsTo('App\User', 'user_id');
	}

	 public function currencies()
    {
        return $this->belongsToMany('App\Currency', 'draft_currencies', 'draft_id', 'currency_id');
    }
}

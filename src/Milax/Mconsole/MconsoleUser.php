<?php

namespace Milax\Mconsole;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MconsoleUser extends Authenticatable
{
	
	protected $table = 'user';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	public function role()
	{
		return $this->belongsTo('App\MconsoleRole');
	}
	
}

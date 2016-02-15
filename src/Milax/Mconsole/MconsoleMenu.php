<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MconsoleMenu extends Model
{
	
	public function roles()
	{
		return $this->belongsToMany('App\MconsoleRole', 'mconsole_roles_menus', 'role_id', 'menu_id');
	}
	
}

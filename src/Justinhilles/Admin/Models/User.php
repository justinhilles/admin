<?php

namespace Justinhilles\Admin\Models;

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser 
{
	use HasRole;
	
	protected $table = 'users';

	public function role()
	{
		return $this->roles()->first();
	}

	public function getRoleId()
	{
		$role = $this->role();

		if(!is_null($role))
		{
			return $role->id;
		}

		return null;
	}

	public function getRoleIds()
	{
		$roles = $this->roles()->get();

		if(!is_null($roles))
		{
			return $roles->lists('id');
		}
		return array();
	}
}
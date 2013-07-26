<?php

namespace Justinhilles\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{	
	protected $table = 'users';

	public static $rules = array(
		'email' => 'required',
		'password' => 'required|confirmed'
	);

	public function removeAllGroups()
	{
		$instance = new static;
		foreach($instance->getGroups() as $group) 
		{
			$instance->removeGroup($group);
		}
	}

	public function addGroups($groups)
	{
		foreach($groups as $group_id)
		{
			$group = \Sentry::getGroupProvider()->findById($group_id);

			$user->addGroup($group);                   
		}
	}
}
<?php

namespace Justinhilles\Admin\Models;

use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Cartalyst\Sentry\Users\Eloquent\User implements RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	public static $rules = array(
		'email' => 'required',
		'password' => 'confirmed'
	);

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}


	public function removeAllGroups()
	{
		foreach($this->getGroups() as $group) 
		{
			$this->removeGroup($group);
		}
	}

	public function addGroups($groups)
	{
		foreach($groups as $group_id)
		{
			$group = \Sentry::getGroupProvider()->findById($group_id);

			$this->addGroup($group);                   
		}
	}

	public static function hasPermissionToRoute($route) 
	{
		if($permission = \Config::get('admin::permissions.'.$route)) {
			$permission = explode(',', $permission);

			if(!is_array($permission)) {
				$permission = array($permission);
			}
			
			return \Sentry::getUser()->hasAnyAccess($permission);
		}
		return true;
	}
}
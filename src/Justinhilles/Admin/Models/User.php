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

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = array('first_name', 'last_name', 'email', 'password');

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

	public function fullname()
	{
		return implode(' ', array($this->first_name, $this->last_name));
	}

    public function syncPermissions($values = array())
    {
    	$permissions = array();

    	//Get Current Keys of Permissions
    	$current = (array) array_keys($this->permissions);

    	//Get Keys of New Permissions
    	$new = (array) array_values((array) $values);

    	//Find which permissions will be added
    	$add = (array) array_fill_keys(array_values((array) array_diff($new, $current)), 1);

    	//Find which permissions will be deleted
    	$delete = (array) array_fill_keys(array_values((array) array_diff($current, $new)), 0);
    	
    	//Merge All Permissions
    	$permissions = (array) array_merge($this->permissions, $add, $delete);

    	//Set New Permissions
     	$this->setPermissionsAttribute((array) $permissions);
    }

    public function syncGroups($values = array())
    {
    	//Detach All Groups
        $this->groups()->detach();

        //Reload from passed Values
        $this->groups()->sync((array) $values);
    }

	public function validate()
	{
		if ( ! $login = $this->{static::$loginAttribute})
		{
			throw new LoginRequiredException("A login is required for a user, none given.");
		}

		// Check if the user already exists
		$query = $this->newQuery();
		$persistedUser = $query->where($this->getLoginName(), '=', $login)->first();

		if ($persistedUser and $persistedUser->getId() != $this->getId())
		{
			throw new UserExistsException("A user already exists with login [$login], logins must be unique for users.");
		}

		return true;
	}

    public static function validator()
    {
    	return new \Justinhilles\Admin\Validators\UserValidator;
    }
}
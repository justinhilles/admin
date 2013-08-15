<?php

namespace Justinhilles\Admin\Models;

use \Cartalyst\Sentry\Groups\Eloquent\Group as BaseGroup;

class Group extends BaseGroup
{
	protected $table = 'groups';
	
 	protected $guarded = array();

 	public static $rules = array(
 		'name' => 'required'
 	);

 	public function getDisplayPermissions()
 	{
 		return implode(", ", $this->permissions);
 	}
}
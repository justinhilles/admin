<?php

namespace Justinhilles\Admin\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
 	protected $guarded = array();

 	public function getDisplayPermissions()
 	{
 		return implode(", ", $this->perms()->lists('display_name'));
 	}
}
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
}
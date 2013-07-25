<?php

namespace Justinhilles\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table = 'groups';
	
 	protected $guarded = array();

 	public static $rules = array(
 		'name' => 'required'
 	);
}
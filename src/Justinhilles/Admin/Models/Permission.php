<?php

namespace Justinhilles\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
 	protected $guarded = array();

 	protected $table = 'permissions';

 	public static $rules = array();
}
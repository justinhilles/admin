<?php

namespace Justinhilles\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
 	protected $guarded = array();

 	protected $table = 'permissions';

    public static $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
        'unique' => true
    );

 	public static $rules = array(
 		'name' => 'required'
 	);
}
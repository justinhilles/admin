<?php namespace Justinhilles\Admin\Validators;

class UserValidator extends Validator {

	public static $rules = array(
		'email' => 'required',
		'password' => 'confirmed'
	);
	
}
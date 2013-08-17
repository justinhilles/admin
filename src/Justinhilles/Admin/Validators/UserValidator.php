<?php namespace Justinhilles\Admin\Validators;

class UserValidator extends Validator {

	public static $rules = array(
		'email' => 'required',
		'password' => 'confirmed'
	);

	public function handle($user)
	{
		$input = $this->data();

		$user->fill(array_except($input, 'password', 'password_confirmation', 'permissions', 'groups', 'activated'));

		$user->activated = isset($input['activated']) ? true : false;

        $user->syncGroups(isset($input['groups']) ? $input['groups'] : array()); 
        
        $user->syncPermissions(isset($input['permissions']) ? $input['permissions'] : array()); 

        if(isset($input['password']) AND !empty($input['password'])) {
        	$user->password = $input['password'];
        }

        $user->save();
	}
	
}
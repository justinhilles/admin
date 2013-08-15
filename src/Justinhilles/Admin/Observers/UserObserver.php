<?php namespace Justinhilles\Admin\Observers;

class UserObserver {

	public function saving($user)
	{
        $user->groups()->detach();

        $user->groups()->sync(\Input::get('groups', array()));

        $user->syncPermissions(\Input::only('permissions', 'superuser'));

        // if($password = \Input::get('password')) {
        //     $password_validator = \Validator::make(\Input::only('password', 'password_confirmation'), array('password' => 'required|confirmed'));

        //     if($password_validator->passes()) {
        //         $user->password = \Input::only('password');
        //     }else{
        //         throw new \Exception('Passwords do not match');
        //     }
        // }

        $user->activated = \Input::has('activated') ? true : false;
	}
}
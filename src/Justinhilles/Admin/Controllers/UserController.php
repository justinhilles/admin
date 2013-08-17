<?php namespace Justinhilles\Admin\Controllers;

use Justinhilles\Admin\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController {

	public function forgot()
	{
		return View::make('admin::users.forgot');
	}

	public function do_forgot()
	{
		try {
		    // Find the user using the user email address
		    $user = \Sentry::getUserProvider()->findByLogin(\Input::get('email'));

			\Mail::send('admin::emails.forgot', array('user' => $user), function($message) use($user) {
			    $message->to($user->email, $user->fullname())->subject('Password Reset');
			});

			return Redirect::route('admin.login')->with('success', 'Email sent!');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
	}

	public function reset($code)
	{
		try {

			$user = \Sentry::getUserProvider()->findByResetPasswordCode($code);

			return View::make('admin::users.reset', compact('user'));

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
		    echo 'User was not found.';
		}
	}

	public function do_reset($code)
	{
		try {

			$user = \Sentry::getUserProvider()->findByResetPasswordCode($code);

			$input = \Input::only('password', 'password_confirmation');

			$validator = \Validator::make($input, array('password' => 'confirmed|required'));

			if($validator->passes()) {
				if($user->checkResetPasswordCode($code)) {
					if($user->attemptResetPassword($code, $input['password'])){
						return Redirect::route('admin.login')->with('success', 'Password Reset!');
					}
				}
			}		

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
		    echo 'User was not found.';
		}
	}
}
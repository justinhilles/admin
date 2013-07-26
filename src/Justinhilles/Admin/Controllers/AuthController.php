<?php

namespace Justinhilles\Admin\Controllers;

use Justinhilles\Admin\Controllers\BaseController;

class AuthController extends BaseController {

    protected $views = 'admin::users';

    protected $routes = 'users';

    public function __construct()
    {
    	$this->user = new \Justinhilles\Admin\Models\User;
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
        if( \Sentry::check() ) {
            return \Redirect::route('admin.dashboard');
        } else {
            return \View::make($this->view('login'));
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function do_login()
    {
        try
        {
            $user = \Sentry::authenticate(\Input::only('email', 'password'));

             return \Redirect::route('admin.dashboard');
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $error = 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $error = 'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            $error = 'Wrong password, try again.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $error = 'User was not found.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $error = 'User is not activated.';
        }
        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }

        return \Redirect::route('admin.login')
                ->withInput(\Input::except('password'))
                ->with( 'error', $error );   
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        \Sentry::logout();
        
        return \Redirect::to(\Config::get('admin::config.prefix'));
    }

}
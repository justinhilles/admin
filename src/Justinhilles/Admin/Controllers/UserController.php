<?php

namespace Justinhilles\Admin\Controllers;

use Justinhilles\Admin\Controllers\BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Zizaco\Confide\ConfideFacade as Confide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Justinhilles\Admin\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController {

    protected $views = 'admin::users';

    protected $routes = 'users';

    public function __construct()
    {
    	$this->user = new User;
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
        if( Auth::user() ) {
            // If user is logged, redirect to internal 
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::route('admin.dashboard');
        }
        else
        {
            return View::make($this->view('login'));
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function do_login()
    {

        $input = (array_except(Input::all(), '_token') + array('username' => Input::get('email')));

        if ( Confide::logAttempt( $input ) ) {

            if (Session::has('redirect')) {
                return Redirect::get('redirect');
            }
            
            return Redirect::route('admin.dashboard');

        } else {

            if( Confide::isThrottled( $input ) ) {
                $error = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif( $this->user->checkUserExists( $input ) and ! $this->user->isConfirmed( $input ) ) {
                $error = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $error = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            Session::flash('error', $error);

            return Redirect::route('admin.login')
                            ->withInput(Input::except('password'));
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function confirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function forgot()
    {
        return View::make($this->view('forgot'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function do_forgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) ) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::action('UserController@login');
        }
        else
        {
            Session::flash('error', Lang::get('confide::confide.alerts.wrong_password_forgot'));
                        return Redirect::action('UserController@forgot')
                            ->withInput();
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function reset_password( $token )
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function do_reset_password()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::action('UserController@reset_password', array('token'=>$input['token']))
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        Confide::logout();
        
        return Redirect::to('/admin');
    }

}
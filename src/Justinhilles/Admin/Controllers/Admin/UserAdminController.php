<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Justinhilles\Admin\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserAdminController extends AdminController {

    protected $views = 'admin::users';

    protected $routes = 'admin.users';

    public function __construct()
    {
        $this->links = self::getLinks();
        $this->user = new User;
    }

    public static function getLinks()
    {
        return (array) array('Users' => \Config::get('admin::dashboard.fieldsets.Admin.Users')) + (array) \Config::get('admin::dashboard.fieldsets.Admin.Users.children');
    }

    public function index()
    {
        $users = $this->user->paginate(10);

        return \View::make($this->view('index'), array('users' => $users, 'links' => $this->links));        
    }

    public function dashboard()
    {
        return \View::make($this->view('dashboard'));
    }

    /**
     * Displays the form for account creation
     */
    public function create()
    {
        return \View::make($this->view('create'), array('links' => $this->links));
    }

    /**
     * Stores new account
     */
    public function store()
    {
        try
        {
            $user = \Sentry::getUserProvider()->create(\Input::only('email', 'password'));

            return \Redirect::route('admin.users.edit', array($user->id))->with( 'success' , 'User Created');
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $error = 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $error =  'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $error =  'User with this login already exists.';
        }

        return \Redirect::route($this->route('create'))->with( 'error', $error );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = \Sentry::getUserProvider()->findById($id);

        if (is_null($user))
        {
            return \Redirect::route($this->route('index'));
        }

        return \View::make($this->view('edit'), array('user' => $user, 'links' => $this->links));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            $user = \Sentry::getUserProvider()->findById($id);

            $user->update(\Input::except('_token', 'password_confirmation'));

            return \Redirect::route($this->route('edit'), $id)->with('success', 'User Updated');
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $error = 'User with this login already exists.';
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $error = 'User was not found.';
        }
        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }

        return \Redirect::route($this->route('edit'), $id)
            ->withInput()
            ->with('error', $error);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            // Find the user using the user id
            $user = \Sentry::getUserProvider()->findById($id);

            // Delete the user
            $user->delete();

            //Return to user home
            return \Redirect::route('admin.users.index')->with('success', 'User deleted');
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return \Redirect::route('admin.users.index')->with('error', 'User not found');
        }
    }
}
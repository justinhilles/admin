<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\User;

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
        $users = $this->user->paginate(\Config::get('admin::config.per_page'));

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
            $input = \Input::only('email', 'first_name', 'last_name', 'password', 'password_confirmation', 'groups', 'permissions');

            $validator = \Validator::make($input, User::$rules);

            if($validator->passes())
            {
                $user = $this->user->create(array_except($input, 'password_confirmation'));

                return \Redirect::route('admin.users.edit', array($user->id))->with( 'success' , 'User Created');
            }

            throw new \Exception($validator->messages());
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
        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }

        return \Redirect::route($this->route('create'))->withInput()->with( 'error', $error );
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
            $user = $this->user->findOrFail($id);

            $input = \Input::except('_token', 'groups','password', 'password_confirmation');

            $validator = \Validator::make($input, User::$rules);

            if($validator->passes())
            {
                $user->removeAllGroups();

                if($groups = \Input::get('groups')) 
                {
                    $user->addGroups($groups);
                }

                if($permissions = \Input::get('permissions')) {
                    $input['permissions'] = array_fill_keys(array_values($permissions), 1);
                }

                if($password = \Input::get('password'))
                {
                    $password_validator = \Validator::make(\Input::only('password', 'password_confirmation'), array('password' => 'required|confirmed'));

                    if($password_validator->passes()) {
                        $input = array_merge($input, \Input::only('password'));
                    }else{
                        throw new \Exception('Passwords do not match');
                    }
                }

                if(!isset($input['activated'])) {
                    $input['activated'] = 0;
                }

                $user->update($input);

                return \Redirect::route($this->route('edit'), $id)->with('success', 'User Updated');
            }

            return \Redirect::route($this->route('edit'), $id)->with('error', $validator->messages());
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
<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\User;

class UserAdminController extends AdminController {

    protected $views = 'admin::users';

    protected $routes = 'admin.users';

    public function __construct(User $user)
    {
        $this->user = \Sentry::getUserProvider();
    }

    public function index()
    {
        $users = $this->user->createModel()->paginate($this->per_page);

        return \View::make($this->view('index'), compact('users'));        
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
        return \View::make($this->view('create'));
    }

    /**
     * Stores new account
     */
    public function store()
    {
        try
        {
            $v = User::validator();

            if($v->passes()) {

                $user = $this->user->create($v->data());
                
                return \Redirect::route($this->route('edit'), array($user->id))->with('success' , 'User Created');
            }

            throw new \Exception($v->messages());
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
        $user = $this->user->findById($id);

        if (is_null($user))
        {
            return \Redirect::route($this->route('index'));
        }

        return \View::make($this->view('edit'), compact('user'));
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
            $user = $this->user->findById($id);

            $input = \Input::except('_token', 'groups','password', 'password_confirmation', 'superuser');

            $validator = \Validator::make($input, User::$rules);

            if($validator->passes()) {

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
            $user = $this->user->findById($id);

            // Delete the user
            $user->delete();

            //Return to user home
            return \Redirect::route($this->route('index'))->with('success', 'User deleted');
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return \Redirect::route($this->route('index'))->with('error', 'User not found');
        }
    }
}
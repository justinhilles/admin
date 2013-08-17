<?php namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class UserAdminController extends AdminController {

    protected $views = 'admin::users';

    protected $routes = 'admin.users';

    public function __construct(User $user)
    {
        $this->provider = \Sentry::getUserProvider();
    }

    /**
     * Display Index Page
     * 
     *  @return Response
     */
    public function index()
    {
        //Get all Users and Paginate
        $users = $this->provider->createModel()->paginate($this->per_page);

        //Create View for Index
        return View::make($this->view('index'), compact('users'));        
    }

    /**
     *  Display Dashboard Page
     * 
     *  @return Response
     */
    public function dashboard()
    {
        //Create View for Dashboard
        return View::make($this->view('dashboard'));
    }

    /**
     * Displays the form for account creation
     * 
     *  @return Reponse
     */
    public function create()
    {
        //Create View for Create Form
        return View::make($this->view('create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            //Find user
            $user = $this->provider->findById($id);

            //Check if Users exist
            if (is_null($user)) {

                //Retyrn user to Index
                return Redirect::route($this->route('index'));
            }

            //Show Edit View
            return View::make($this->view('edit'), compact('user'));
        }
        catch(\Exception $e) {
            //Return to Index
            return Redirect::route($this->route('index'));            
        }
    }

    /**
     * Show Edit Screen for Current User
     * 
     *  @return Response
     */
    public function profile()
    {
        try {
            //Get Current User
            $user = \Sentry::getUser();

            // Check if Users exist
            if (is_null($user)) {

                //Return user to Index
                throw new \Exception('User Not Found');
            }

            //Show Edit View
            return View::make($this->view('edit'), compact('user'));
        } 
        catch(\Exception $e) {
            //Return to Index
            return Redirect::route($this->route('index'));
        }
    }

    /**
     * Stores new account
     * 
     * @return Response
     */
    public function store()
    {
        try {

            //Get User Validator
            $v = User::validator();

            //Check if Validation Passes
            if($v->passes()) {

                //Create User
                $user = $this->provider->createModel();

                //Handle Request
                $v->handle($user);
                
                //Return to Edit View
                return Redirect::route($this->route('edit'), array($user->id))->with('success' , 'User Created');
            }

            throw new \Exception($v->messages());
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $error = 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $error =  'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            $error =  'User with this login already exists.';
        }
        catch(\Exception $e) {
            $error = $e->getMessage();
        }

        return Redirect::route($this->route('create'))->withInput()->with( 'error', $error );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try {
            //Find the user using the user id
            $user = $this->provider->findById($id);

            //Get Validator
            $v = User::validator();

            //Check if Form Passes
            if($v->passes()) {

                //Handle Request
                $v->handle($user);

                //Return to Edit Page
                return Redirect::route($this->route('edit'), $id)->with('success', 'User Updated');
            }

            //Throw Form Errors
            throw new \Exception($v->messages());

        } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            $error = 'User with this login already exists.';

        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $error = 'User was not found.';

        } catch(\Exception $e) {
            $error = $e->getMessage();

        }

        //Return User to Edit Page
        return Redirect::route($this->route('edit'), $id)->withInput()->with('error', $error);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            // Find the user using the user id
            $user = $this->provider->findById($id);

            // Delete the user
            $user->delete();

            //Return to user home
            return Redirect::route($this->route('index'))->with('success', 'User deleted');

        } 
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {

            return Redirect::route($this->route('index'))->with('error', 'User not found');
        }
    }
}
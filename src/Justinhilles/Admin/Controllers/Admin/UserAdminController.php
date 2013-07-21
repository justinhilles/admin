<?php 

namespace Justinhilles\Admin\Controllers\Admin;

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
        return (array) array('Users' => Config::get('admin::dashboard.fieldsets.Admin.Users')) + (array) Config::get('admin::dashboard.fieldsets.Admin.Users.children');
    }

    public function index()
    {
        $users = $this->user->paginate(10);

        return View::make($this->view('index'), array('users' => $users, 'links' => $this->links));        
    }

    public function dashboard()
    {
        return View::make($this->view('dashboard'));
    }

    /**
     * Displays the form for account creation
     */
    public function create()
    {
        return View::make($this->view('create'), array('links' => $this->links));
    }

    /**
     * Stores new account
     */
    public function store()
    {
        $user = $this->user;

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );


        // Save if valid. Password field will be hashed before save
        $user->save();

        if ( $user->id )
        {
            if($role = Input::get('role'))
            {
                $user->roles()->attach($role);
            }
 
            return Redirect::action('UserAdminController@login')
                ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

            return Redirect::action('UserAdminController@create')
                    ->withInput(Input::except('password'))
                    ->with( 'error', $error );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (is_null($user))
        {
            return Redirect::route($this->route('index'));
        }

        return View::make($this->view('edit'), array('user' => $user, 'links' => $this->links));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), array('_method'));
        $user = User::find($id);

        $user->email = $input['email'];
        $user->username = $input['username'];
        $user->password = $input['password'];
        $user->password_confirmation = $input['password_confirmation'];
        $user->roles()->sync((array) Input::get('roles'));
        
        if($user->amend())
        {
            return Redirect::route('admin.users.index');
        }

        return Redirect::route('admin.users.edit', $id)
            ->withInput()
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return Redirect::route($this->route('index'));
    }
}
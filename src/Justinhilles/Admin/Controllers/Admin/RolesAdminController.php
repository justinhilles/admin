<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\Role;
use Illuminate\Support\Facades\View;

class RolesAdminController extends AdminController {

    /**
     * Role Repository
     *
     * @var Role
     */
    protected $role;

    protected $views = 'admin::roles';

    protected $routes = 'admin.roles';

    public function __construct(Role $role)
    {
        $this->role = $role;

        $this->links = UserAdminController::getLinks();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->role->all();

        return View::make($this->view('index'), array('roles' => $roles, 'links' => $this->links));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make($this->view('create'), array('links' => $this->links));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Role::$rules);

        if ($validation->passes())
        {
            $role = $this->role->create(array_except($input, 'permissions'));

            $role->savePermissions(array_map('intval', $input['permissions']));

            return Redirect::route($this->route('index'));
        }

        return Redirect::route($this->route('create'))
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->role->find($id);

        if (is_null($role))
        {
            return Redirect::route($this->route('index'));
        }

        return View::make($this->view('edit'), array('role' => $role, 'links' => $this->links));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Role::$rules);

        if ($validation->passes())
        {
            $role = $this->role->find($id);
            $role->update(array_except($input, 'permissions'));
            $role->savePermissions(array_map('intval', $input['permissions']));

            return Redirect::route($this->route('edit'), $id);
        }

        return Redirect::route($this->route('edit'), $id)
            ->withInput()
            ->withErrors($validation)
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
        $this->role->find($id)->delete();

        return Redirect::route($this->route('index'));
    }

}
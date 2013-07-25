<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\Permission;

class PermissionsAdminController extends AdminController {

    /**
     * Permission Repository
     *
     * @var Permission
     */
    protected $permission;

    protected $views = 'admin::permissions';

    protected $routes = 'admin.permissions';

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        
        $this->links = \Justinhilles\Admin\Controllers\Admin\UserAdminController::getLinks();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->permission->all();

        return \View::make($this->view('index'),  array('permissions' => $permissions, 'links' => $this->links));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make($this->view('create'), array('links' => $this->links));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();
        $validation = \Validator::make($input, Permission::$rules);

        if ($validation->passes())
        {
            $this->permission->create($input);

            return \Redirect::route($this->route('index'));
        }

        return \Redirect::route($this->route('create'))
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permission->findOrFail($id);

        return \View::make($this->view('show'), compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permission->find($id);

        if (is_null($permission))
        {
            return \Redirect::route($this->route('index'));
        }

        return \View::make($this->view('edit'), array('permission' => $permission, 'links' => $this->links));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(\Input::all(), '_method');
        $validation = \Validator::make($input, Permission::$rules);

        if ($validation->passes())
        {
            $permission = $this->permission->find($id);
            $permission->update($input);

            return \Redirect::route($this->route('index'));
        }

        return \Redirect::route($this->route('edit'), $id)
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
        $this->permission->find($id)->delete();

        return \Redirect::route($this->route('index'));
    }

}
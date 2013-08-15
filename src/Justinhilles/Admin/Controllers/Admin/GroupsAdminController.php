<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Models\Group;

class GroupsAdminController extends AdminController {

    /**
     * Role Repository
     *
     * @var Role
     */
    protected $group;

    protected $views = 'admin::groups';

    protected $routes = 'admin.groups';

    public function __construct(Group $group)
    {
        $this->group = \Sentry::getGroupProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groups = $this->group->createModel()->paginate($this->per_page);

        return \View::make($this->view('index'), compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make($this->view('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try{

            $input = \Input::only('name', 'permissions');

            $validation = \Validator::make($input, Group::$rules);

            if ($validation->passes())
            {
                if(isset($input['permissions'])){
                    $input['permissions'] = array_fill_keys(array_values($input['permissions']), 1);
                } else{
                    $input['permissions'] = array();
                }
                $group = $this->group->create($input);

                return \Redirect::route($this->route('edit'), array($group->id));
            }

            throw new \Exception('There were validation errors');
        }
        catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            $error = 'Name field is required';
        }
        catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            $error = 'Group already exists';
        }

        return \Redirect::route($this->route('create'))
            ->withInput()
            ->with('message', $error);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            $group = $this->group->findById($id);

            return \View::make($this->view('edit'), compact('group'));            
        }
        catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            $error = 'Group already exists.';
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $error = 'Group was not found.';
        }

        return \Redirect::route($this->route('index'))->with('error', $error);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try{

            $input = \Input::only('name', 'permissions');

            $validation = \Validator::make($input, Group::$rules);

            if ($validation->passes()) {
                $group = $this->group->findById($id);

                $add = array_fill_keys(array_values((array) $input['permissions']), 1);
                $remove = array_fill_keys(array_keys(array_diff_key($group->permissions, $add)), 0);
                $permissions = $add + $remove;

                $input['permissions'] = $permissions;

                $group->update($input);

                return \Redirect::route($this->route('edit'), array($group->id))->with('success', 'Group Updated');
            }

            throw new \Exception('There were validation errors');
        }
        catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            $error = 'Name field is required';
        }
        catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            $error = 'Group already exists';
        }

        return \Redirect::route($this->route('create'))
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
            // Find the group using the group id
            $group = $this->group->findById($id);

            // Delete the group
            $group->delete();

            return \Redirect::route($this->route('index'))->with('success', 'Group Deleted');
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $error = 'Group was not found.';
        }

        return \Redirect::route($this->route('index'))->with('error', $error);
    }

}
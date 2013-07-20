<?php namespace Justinhilles\Admin\Controllers;

use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller {

	protected $views = null;

	protected $routes = null;

    protected function view($view, $format = '%s.%s')
    {
        return sprintf($format, $this->views, $view);
    }

    protected function route($route, $format = '%s.%s')
    {
    	return sprint($format, $this->routes, $route);
    }

    public function upload()
    {
        
    }
}
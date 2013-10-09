<?php 

namespace Justinhilles\Admin\Controllers\Admin;

use Justinhilles\Admin\Controllers\BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController {

    protected $per_page = 10;

    public function __construct()
    {
        $this->per_page = Config::get('cms::config.admin.per_page', $this->per_page);
    }

    public function handleUpload($name, $path = "uploads")
    {
        if($file = \Input::file($name)) {
            $filename = $file->getClientOriginalName();
            if($file->move($path, $filename))
            {
                return $path.'/'.$filename;
            }
        }
        return false;
    }

    public function index()
    {
        
    }
}
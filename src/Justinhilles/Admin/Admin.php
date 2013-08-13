<?php namespace Justinhilles\Admin;

use Justinhilles\Admin\Renderers\DashboardRenderer;
use Justinhilles\Admin\Renderers\NavRenderer;
use Illuminate\Support\Facades\Config;

class Admin {

	public function dashboard()
	{
		return new DashboardRenderer((array) Config::get('admin::dashboard'));
	}

	public function nav()
	{
		return NavRenderer::create(Config::get('admin::dashboard', array()));
	}
}
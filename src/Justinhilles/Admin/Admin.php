<?php namespace Justinhilles\Admin;

use Justinhilles\Admin\Renderers\DashboardRenderer;
use Justinhilles\Admin\Renderers\NavRenderer;
use Illuminate\Support\Facades\Config;

class Admin {

	public function dashboard()
	{
		return new DashboardRenderer($this->getDashboardConfig());
	}

	public function nav()
	{
		return NavRenderer::create($this->getDashboardConfig());
	}

	public function getDashboardConfig()
	{
		return (array) Config::get('admin::dashboard', array());
	}
}
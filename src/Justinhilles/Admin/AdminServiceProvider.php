<?php namespace Justinhilles\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {

	use \Justinhilles\Admin\Providers\BaseServiceProvider;

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('justinhilles/admin');

		$this->registerFromConfig('admin');
	}

	public function boot()
	{
		$this->registerCollection();
		
		$this->bootFromConfig('admin');
	}

	/**
	 * Register Basset Collection
	 *
	 * @return void
	 */
	public function registerCollection()
	{
		$this->app['basset']->package('justinhilles/admin');

		$this->app['basset']->collection(\Config::get('admin::config.collection', 'admin'), function($collection) {

			if($stylesheets = \Config::get('admin::config.stylesheets')) {
				foreach($stylesheets as $stylesheet) {
					$collection->stylesheet($stylesheet);
				}
			}

			if($javascripts = \Config::get('admin::config.javascripts')) {
				foreach($javascripts as $javascript) {
					$collection->javascript($javascript);
				}
			}
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('admin');
	}
}
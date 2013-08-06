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

		$this->registerFromConfig();

		$this->registerCollection();
	}

	/**
	 * Register Basset Collection
	 *
	 * @return void
	 */
	public function registerCollection()
	{
		\App::make('basset')->collection('admin', function($collection) {

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
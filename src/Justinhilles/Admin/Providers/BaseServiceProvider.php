<?php 

namespace Justinhilles\Admin\Providers;

trait BaseServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function registerFromConfig()
	{
		$this->registerProviders(\Config::get('admin::app.providers'));

		$this->registerAliases(\Config::get('admin::app.aliases'));

		$this->registerObservers(\Config::get('admin::app.observers'));

		$this->registerComponents(\Config::get('admin::app.components'));

		$this->registerCommands(\Config::get('admin::app.commands'));

		$this->registerFiles(\Config::get('admin::app.files'));
	}

	public function registerObservers($observers = array())
	{
		if(!empty($observers)) {
			foreach($observers as $model => $observer) {
				$model::observe(new $observer);
			}
		}
	}

	public function registerAliases($aliases = array())
	{
		if(!empty($aliases)) {
			foreach($aliases as $alias => $original) {
				class_alias($original, $alias);
			}
		}		
	}

	public function registerProviders($providers = array()) 
	{
		if(!empty($providers)) {
			foreach($providers as $provider) {
				$this->app->register($provider);
			}	
		}
	}

	public function registerCommands($commands = array())
	{
		if(!empty($commands)) {
			foreach($commands as $alias => $class) {
				$this->app[$alias] = $this->app->share(function($app) use ($class) {
					return new $class;
				});

				$this->commands($alias);				
			}
		}
	}

	public function registerFiles($files = array())
	{
		if(!empty($files)) {
			foreach($files as $path) {
				include $path;
			}
		}
	}

	public function registerComponents($components = array())
	{
		if(!empty($components)) {
			foreach($components as $component => $class) {
				$this->app->bind($component, function() use($class) {
					return new $class;
				});
			}
		}
	}
}
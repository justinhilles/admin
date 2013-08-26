<?php 

namespace Justinhilles\Admin\Providers;

trait BaseServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function registerFromConfig($name = null)
	{
		$this->registerProviders(\Config::get($name.'::app.providers'));

		$this->registerConfig(\Config::get($name.'::app.config'));

		$this->registerAliases(\Config::get($name.'::app.aliases'));

		$this->registerComponents(\Config::get($name.'::app.components'));

		$this->registerCommands(\Config::get($name.'::app.commands'));
	}

	public function bootFromConfig($name = null)
	{
		$this->registerObservers(\Config::get($name.'::app.observers'));

		$this->registerFiles(\Config::get($name.'::app.files'));		
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
				if(!class_exists($alias)) {
					class_alias($original, $alias);
				}
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
				if(file_exists($path)) {
					include $path;
				}
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

	public function registerConfig($config = array())
	{
		if(!empty($config)) {
			foreach($config as $key => $value) {
				\Config::set($key, $value);
			}
		}
	}
}
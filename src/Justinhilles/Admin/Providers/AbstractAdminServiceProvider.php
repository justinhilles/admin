<?php namespace Justinhilles\Admin\Providers;

use Illuminate\Support\ServiceProvider;

abstract class AbstractAdminServiceProvider extends ServiceProvider {

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
}
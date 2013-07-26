<?php namespace Justinhilles\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('justinhilles/admin');
    }
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->loadConfig();

		$this->loadProviders();

		$this->loadAliases();

		$this->loadCollection();

		$this->loadRoutes();

		$this->registerCommands();
	}

	public function loadConfig()
	{
		$this->app['config']->package('justinhilles/admin', __DIR__.'/../../config');
	}

	public function loadRoutes()
	{
		include __DIR__.'/../../routes/routes.php';
		include __DIR__.'/../../filters.php';
	}

	public function loadCollection()
	{
		App::make('basset')->collection('admin', function($collection) {

			if($stylesheets = Config::get('admin::config.stylesheets')) {
				foreach($stylesheets as $stylesheet) {
					$collection->stylesheet($stylesheet);
				}
			}

			$collection->stylesheet(__DIR__.'/../../../public/assets/stylesheets/admin.css');

			if($javascripts = Config::get('admin::config.javascripts')) {
				foreach($javascripts as $javascript) {
					$collection->javascript($javascript);
				}
			}
			
            $collection->javascript(__DIR__.'/../../../public/assets/javascripts/admin.js');
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

	public function loadProviders()
	{
		$providers = Config::get('admin::config.providers');

		if(count($providers)) {
			foreach($providers as $provider) {
				$this->app->register($provider);
			}
		}
	}

	public function loadAliases()
	{
		$aliases = Config::get('admin::config.aliases');

		if(count($aliases)) {
			foreach($aliases as $alias => $original) {
				if(!class_exists($alias)) {
					class_alias($original, $alias);
				}				
			}

		}
	}

	/** register the custom commands **/
	public function registerCommands()
	{
		$commands = Config::get('admin::config.commands');

		if(count($commands) > 0) {
			foreach($commands as $alias => $class) {
				$this->app[$alias] = $this->app->share(function($app) use ($class) {
					return new $class;
				});

				$this->commands($alias);				
			}
		}
	}
}
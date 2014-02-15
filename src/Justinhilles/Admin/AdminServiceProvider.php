<?php namespace Justinhilles\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AdminServiceProvider extends ServiceProvider {

    use \Justinhilles\Admin\Providers\BaseServiceProvider;

    const PACKAGE_NAME = 'admin';

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

        $this->registerFromConfig(self::PACKAGE_NAME);
    }

    public function boot()
    {       
        $this->bootFromConfig(self::PACKAGE_NAME);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(self::PACKAGE_NAME);
    }
}
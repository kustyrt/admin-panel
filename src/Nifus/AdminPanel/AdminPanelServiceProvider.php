<?php namespace Nifus\AdminPanel;

use Illuminate\Support\ServiceProvider;

class AdminPanelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        \View::addNamespace('admin-panel', dirname( __FILE__ ) . "/../..");
        \Lang::addNamespace('admin-panel', dirname( __FILE__ ) . "/../../lang");
        \Config::addNamespace('admin-panel', dirname( __FILE__ ) . "/../../config");
        require __DIR__ . '/../../routes.php';
        require __DIR__ . '/../../filters.php';
		//$this->package('nifus/admin');

    }


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		//return array('admin-panel');
	}

}
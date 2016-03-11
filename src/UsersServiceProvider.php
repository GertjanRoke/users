<?php

namespace Snatertj\Users;

/**
 * 
 * @author Gertjan Roke
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class UsersServiceProvider extends ServiceProvider
{
    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->setupRoutes($this->app->router);
	/**
         * Add all the Models
         */
        $this->publishes([
            __DIR__.'/Models/app' => app_path()
        ], 'models');
        /**
         * Add all the config files
         */
        $this->publishes([
            __DIR__.'/config' => config_path()
        ], 'config');
        /**
         * Add all the request files
         */
        $this->publishes([
            __DIR__.'/Http/Requests' => app_path('/Http/Requests')
        ], 'requests');
        /**
         * Add all the view files
         */
        $this->publishes([
            __DIR__.'/views' => base_path('/resources/views/snatertj/usersmanager')
        ], 'requests');
        /**
         * Add all the style and script files
         */
        $this->publishes([
            __DIR__.'/assets/css' => public_path('/assets/css'),
            __DIR__.'/assets/js' => public_path('/assets/js')
        ], 'styles and scripts');
        /**
         * Add all the migrations
         */
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'migrations');
        /**
         * Add all the database seeds
         */
        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds')
        ], 'seeds');
        /**
         * Add all the controllers
         */
        $this->publishes([
            __DIR__.'/Http/Controllers' => app_path('/Http/Controllers')
        ], 'controllers');
    }
	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'App\Http\Controllers\Snatertj\Users'], function($router)
		{
			require __DIR__.'/Http/routes.php';
		});
	}
	public function register()
	{
		$this->registerUsermanager();
		config([
				'config/usermanager.php',
		]);
	}
	private function registerUsermanager()
	{
		$this->app->bind('usermanager',function($app){
			return new Usermanager($app);
		});
	}
}

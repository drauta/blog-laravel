<?php
namespace Drauta\BlogLaravel;

use Illuminate\Support\ServiceProvider;

class BlogLaravelServiceProvider extends ServiceProvider {


	public function boot()
  {

		/*Assets , CKEDITOR*/
		$this->publishes([
        __DIR__.'/../assets/' => public_path('drauta/bloglaravel'),
    ], 'public');
		/*Migrations*/
		$this->publishes([
	         __DIR__.'/../database/migrations/' => database_path('migrations')
	     ], 'migrations');



  }
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

		/*Publicar vistas*/

		//This load routes files
		$this->app['router']->group(['namespace' => 'Drauta\BlogLaravel\Http\Controllers'], function () {
			require __DIR__.'/Http/routes.php';
		});

		// This load views directory

		/*De momento se queda asi*/
		$this->loadViewsFrom(__DIR__.'/../views', 'blogLaravel');

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}

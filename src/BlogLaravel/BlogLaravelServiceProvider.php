<?php namespace Drauta\BlogLaravel;

use Illuminate\Support\ServiceProvider;

class BlogLaravelServiceProvider extends ServiceProvider {


	public function boot()
  {

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
		//This load routes files
		$this->app['router']->group(['namespace' => 'BlogLaravel\Http\Controllers'], function () {
			require __DIR__.'/Http/routes.php';
		});




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

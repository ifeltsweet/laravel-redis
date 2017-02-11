<?php

namespace LaravelRedis;

use Illuminate\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('LaravelRedis\RedisManager', function($app) {
        	return new RedisManager($app['config']['database.redis']);
        });

        // To support default Illuminate Redis Facade and for those who expect 'redis'
        // to be aliased. 
    	$this->app->alias('LaravelRedis\RedisManager', 'redis');
    }

    /**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['LaravelRedis\RedisManager', 'redis'];
	}
}
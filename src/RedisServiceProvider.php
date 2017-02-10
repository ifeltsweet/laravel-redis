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
        $this->app->singleton('FootyRoom\Support\Redis\RedisManager');
    }

    /**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('FootyRoom\Support\Redis\RedisManager');
	}
}
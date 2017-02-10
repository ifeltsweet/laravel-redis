<?php

namespace LaravelRedis;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Manager;
use Redis;

class RedisManager extends Manager
{
    /**
     * Create a new manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'php redis';
    }

    /**
     * Create PhpRedis client.
     *
     * @return Redis
     */
    protected function createPhpRedisDriver()
    {
        $redis = new Redis();

        $config = $this->getDefaultConfig();

        $redis->connect($config['host'], $config['port'], $config['timeout']);

        if (isset($config['password'])) {
            $redis->auth($config['password']);
        }

        if (isset($config['read_timeout'])) {
            $redis->setOption(Redis::OPT_READ_TIMEOUT, $config['read_timeout']);
        }

        return $redis;
    }

    /**
     * Get default configuration.
     *
     * @return array
     */
    protected function getDefaultConfig()
    {
        return $this->config->get('database.connections.redis.default');
    }
}

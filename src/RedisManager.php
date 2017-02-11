<?php

namespace LaravelRedis;

use Illuminate\Support\Manager;
use Redis;

class RedisManager extends Manager
{
    /**
     * Create a new manager instance.
     *
     * @param array $config
     */
    public function __construct($config)
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
        return 'PhpRedis';
    }

    /**
     * Create PhpRedis client.
     *
     * @return Redis
     */
    protected function createPhpRedisDriver()
    {
        $redis = new Redis();

        $config = $this->config['default'];

        $redis->connect($config['host'], $config['port'], $config['timeout']);

        if (isset($config['password'])) {
            $redis->auth($config['password']);
        }

        if (isset($config['read_timeout'])) {
            $redis->setOption(Redis::OPT_READ_TIMEOUT, $config['read_timeout']);
        }

        return $redis;
    }
}

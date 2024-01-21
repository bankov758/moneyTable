<?php

declare(strict_types = 1);

namespace app\core;

/**
 * @property-read ?array $db
 */
class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [ //could have more than the db configuration
                'host'     => $env['DB_HOST'],
                'user'     => $env['DB_USER'],
                'pass'     => $env['DB_PASS'],
                'database' => $env['DB_DATABASE'],
                'driver'   => $env['DB_DRIVER'] ?? 'mysql',
            ]
        ];
    }

//    public function getDb()
//    {
//        return $this->config['db'];
//    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
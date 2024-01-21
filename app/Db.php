<?php

declare(strict_types = 1);

namespace App;

use PDO;
use PDOException;

//tells php that we will delegate methods called on DB to PDO
/**
 * @mixin PDO
 */
class DB
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $defaultOptions = [                                     // stops the emulation of the prepared statements -> we can not reuse the same parameter
            PDO::ATTR_EMULATE_PREPARES   => false,              // and everything is returned in its type and not as string
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // the result is an associative array with the column names being the key
        ];

        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions //?? means coalesce
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    /*
     * if you have an instance of the DB class and call a method that is not explicitly defined in the DB class,
     * the __call method will pass the method call to the corresponding method in the PDO instance.
     * This makes it possible to use any method that PDO provides directly on an instance of the DB class
     * without explicitly defining those methods in the DB class itself.
     * **/
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}
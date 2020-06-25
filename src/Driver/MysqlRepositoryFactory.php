<?php

declare(strict_types=1);

namespace src\Driver;

use Psr\Container\ContainerInterface;

class MysqlRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $conn = new \PDO($config['db']['dsn']);
        
        return new MysqlRepository($conn);
    }
}


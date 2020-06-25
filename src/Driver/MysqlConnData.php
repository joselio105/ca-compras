<?php

declare(strict_types=1);

namespace src\Driver;

require_once 'Vendor/psr/container/src/ContainerInterface.php';
require_once 'src/Driver/MysqlRepository.php';

use Psr\Container\ContainerInterface;

class MysqlConnData implements ContainerInterface
{

    public function __construct()
    {}

    public function get($id)
    {
        $dsn = "mysql:dbname=compras;host=localhost";
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        
        $conn = new \PDO($dsn, 'root', '', $options);
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        return new MysqlRepository($conn);        
    }

    public function has($id)
    {}
}


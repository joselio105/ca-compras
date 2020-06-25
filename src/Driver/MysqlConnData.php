<?php

declare(strict_types=1);

namespace src\Driver;

require_once 'Vendor/psr/container/src/ContainerInterface.php';

use Psr\Container\ContainerInterface;

class MysqlConnData implements ContainerInterface
{

    private $conn;
    
    public function __construct()
    {
        $dsn = "mysql:dbname=compras;host=localhost";
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        
        $this->conn = new \PDO($dsn, 'root', '', $options);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
    }

    public function get($id)
    {        
        return new $id($this->conn);        
    }

    public function has($id)
    {
        return is_object($this->conn);
    }
}


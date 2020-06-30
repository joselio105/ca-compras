<?php

declare(strict_types=1);

namespace src\Driver;

require_once 'Vendor/psr/container/src/ContainerInterface.php';
require_once 'src/Driver/JsonRepository.php';
require_once 'src/Entity/DbMysqlConfig.php';

use Psr\Container\ContainerInterface;
use src\Entity\DbMysqlConfig;

class MysqlConnData implements ContainerInterface
{

    private $conn;
    private $dbConfig;
    private $dbConfigFile;
    
    public function __construct()
    {
        $this->dbConfigFile = 'config/dbMysql.json';
        
        if($this->getConfigData())
        {
            $dsn = "mysql:dbname={$this->dbConfig->getDbName()};host={$this->dbConfig->getDbHost()}";
            $options = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            
            $this->conn = new \PDO($dsn, $this->dbConfig->getDbUser(), $this->dbConfig->getDbPswd(), $options);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        
        
    }

    public function get($id)
    {        
        return new $id($this->conn);        
    }

    public function has($id)
    {
        return is_object($this->conn);
    }
    
    /**
     * Recupera os dados do arquivo de configuração
     * @return boolean
     */
    private function getConfigData()
    {        
        $repo = new JsonRepository($this->dbConfigFile);
        $data = $repo->read();
        if(!empty($data))
        {
            $this->dbConfig = new DbMysqlConfig();
            $this->dbConfig->setDbHost($data['dbHost']);
            $this->dbConfig->setDbName($data['dbName']);
            $this->dbConfig->setDbUser($data['dbUser']);
            $this->dbConfig->setDbPswd($data['dbPswd']);
        }
        
        return is_object($this->dbConfig);
        
    }
}


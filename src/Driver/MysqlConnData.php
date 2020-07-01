<?php

declare(strict_types=1);

namespace src\Driver;

require_once 'Vendor/psr/container/src/ContainerInterface.php';
require_once 'src/Driver/JsonRepository.php';
require_once 'src/Entity/DbMysqlConfig.php';

use Psr\Container\ContainerInterface;
use src\Entity\DbMysqlConfig;
use src\Entity\EntityInterface;

class MysqlConnData implements ContainerInterface
{

    private $conn;
    private $dbConfig;
    private $dbConfigFile;
    private $entity;
    
    public function __construct(EntityInterface $entity)
    {
        $this->dbConfigFile = 'config/dbMysql.json';
        $this->entity = $entity;
        
        if($this->getConfigData())
        {
            $dsn = "mysql:dbname={$this->dbConfig->__get('dbName')};host={$this->dbConfig->__get('dbHost')}";
            $options = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            
            $this->conn = new \PDO($dsn, $this->dbConfig->__get('dbUser'), $this->dbConfig->__get('dbPswd'), $options);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        
        
    }

    public function get($id)
    {        
        return new $id($this->conn, $this->entity);        
    }

    public function has($id)
    {
        return is_object($this->conn);
    }
    
    public function getEntity()
    {
        return $this->entity;
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
            foreach ($this->dbConfig->getFields() as $field)
            {
                $this->dbConfig->__set($field, $data[$field]);
            }
        }
        
        return is_object($this->dbConfig);
        
    }
}


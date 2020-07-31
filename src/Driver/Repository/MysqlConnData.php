<?php

declare(strict_types=1);

namespace src\Driver\Repository;

require_once 'Vendor/psr/container/src/ContainerInterface.php';
require_once 'src/Driver/Repository/JsonRepository.php';
require_once 'src/Entity/Simple/DbMysqlConfig.php';

use Psr\Container\ContainerInterface;
use src\Entity\Simple\DbMysqlConfig;
use src\Entity\EntityInterface;
use src\Entity\EntityFactory;

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
            $dsn = "mysql:dbname={$this->dbConfig->getAtributeValue("dbName")};host={$this->dbConfig->getAtributeValue("dbHost")}";
            $options = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            
            $this->conn = new \PDO($dsn, $this->dbConfig->getAtributeValue("dbUser"), $this->dbConfig->getAtributeValue("dbPswd"), $options);
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
            
            $this->dbConfig = new EntityFactory(new DbMysqlConfig());
            foreach ($this->dbConfig->getAtributes() as $field)
            {
                $this->dbConfig->setAtributeValue($field, $data[$field]);
            }
        }
        
        return is_object($this->dbConfig);
        
    }
}


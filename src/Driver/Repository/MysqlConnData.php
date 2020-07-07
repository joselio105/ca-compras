<?php

declare(strict_types=1);

namespace src\Driver\Repository;

require_once 'Vendor/psr/container/src/ContainerInterface.php';
require_once 'src/Driver/Repository/JsonRepository.php';
require_once 'src/Entity/Simple/DbMysqlConfig.php';
require_once 'Traits/EntityHandlerTrait.php';

use Psr\Container\ContainerInterface;
use src\Entity\Simple\DbMysqlConfig;
use src\Entity\EntityInterface;
use Traits\EntityHandlerTrait;

class MysqlConnData implements ContainerInterface
{
    use EntityHandlerTrait;

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
            foreach ($this->getProperties($this->dbConfig) as $field)
            {
                $this->setProperty($this->dbConfig, $field, $data[$field]);
            }
        }
        
        return is_object($this->dbConfig);
        
    }
}


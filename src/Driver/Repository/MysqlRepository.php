<?php

declare(strict_types=1);

namespace src\Driver\Repository;

require_once 'src/Driver/RepositoryInterface.php';

use src\Entity\EntityInterface;
use libs\Sql\SqlRead;
use src\Driver\RepositoryInterface;
use src\Entity\EntityFactory;

class MysqlRepository implements RepositoryInterface
{
    private $conn;
    private $entity;
    
    public function __construct(\PDO $conn, EntityInterface $entity)
    {
        $this->conn = $conn;
        $this->entity = $entity;
    }

    public function read(SqlRead $read)
    {
        $stmt = $this->conn->prepare($read->__toString());
        $stmt->execute($read->getStamments());
        //$result = $stmt->fetch(\PDO::FETCH_NUM);
        
        $className = $this->entity->getEntityClassName();
        
        $position = 0;
        while($row = $stmt->fetch(\PDO::FETCH_NUM))
        {
            $entity = new EntityFactory(new $className());
            $entity->setAtributesValues($row);                
            $all[$position] = $entity->getEntityObject();
            $position++;
        }
        
        var_dump($all);die;
        return $all;
    }

    public function create(EntityInterface $entity)
    {
        $sql = "INSERT INTO cmp_und(nome, sigla) VALUES(:nome, :sigla)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $und->getNome());
        $stmt->bindParam(":sigla", $und->getSigla());
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update(EntityInterface $entity, $id)
    {}

    public function delete($id)
    {}
}


<?php

declare(strict_types=1);

namespace src\Driver\Repository;

require_once 'src/Driver/RepositoryInterface.php';

use src\Entity\EntityInterface;
use libs\Sql\SqlRead;
use src\Driver\RepositoryInterface;

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
        //var_dump($read->__toString());die;
        $result = $this->conn->query($read->__toString());
        $result = $result->fetchAll(\PDO::FETCH_CLASS);
        var_dump($result);die;
        $className = get_class($this->entity);
        foreach ($result as $r):
            $entity = new $className();
        
            foreach ($entity->getFields() as $field)
            {
                $entity->__set($field, $r[$field]);
            }
            $all[] = $entity;
        endforeach;
        var_dump($all);
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


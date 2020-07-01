<?php

declare(strict_types=1);

namespace src\Driver;

require_once 'src/Driver/RepositoryInterface.php';

use src\Entity\EntityInterface;

class MysqlRepository implements RepositoryInterface
{

    private $conn;
    private $entity;
    
    public function __construct(\PDO $conn, EntityInterface $entity)
    {
        $this->conn = $conn;
        $this->entity = $entity;
    }

    public function read($query=null)
    {
        //$query = (!is_null($query) ? " WHERE {$query}" : null);
        $sql = "SELECT * FROM {$this->entity->getTableName()}";
        $result = $this->conn->query($sql);
        $result = $result->fetchAll(\PDO::FETCH_ASSOC);
        
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


<?php
namespace src\Driver;

use src\Entity\EntityInterface;
use libs\Sql\SqlRead;

interface RepositoryInterface
{
    public function create(EntityInterface $entity);
    
    public function read(SqlRead $sql);
    
    public function update(EntityInterface $entity, int $id);
    
    public function delete(int $id);
}


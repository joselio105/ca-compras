<?php
namespace src\Driver;

use src\Entity\EntityInterface;

interface RepositoryInterface
{
    public function create(EntityInterface $entity);
    
    public function read(string $query=null);
    
    public function update(EntityInterface $entity, int $id);
    
    public function delete(int $id);
}


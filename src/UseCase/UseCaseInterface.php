<?php
namespace src\UseCase;

use src\Driver\RepositoryInterface;
use src\Entity\EntityInterface;

interface UseCaseInterface
{
    public function __construct(RepositoryInterface $repository);
    
    public function create(EntityInterface $entity);
    
    public function read(string $query=null);
    
    public function update(EntityInterface $entity, int $id);
    
    public function delete(int $id);
}


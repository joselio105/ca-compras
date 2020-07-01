<?php
namespace src\UseCase;

use src\Driver\RepositoryInterface;
use src\Entity\EntityInterface;
use libs\Sql\SqlRead;

interface UseCaseInterface
{
    public function __construct(RepositoryInterface $repository);
    
    public function create(EntityInterface $entity);
    
    public function read(SqlRead $read);
    
    public function update(EntityInterface $entity, int $id);
    
    public function delete(int $id);
}


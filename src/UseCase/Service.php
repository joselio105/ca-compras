<?php
namespace src\UseCase;

require_once 'src/UseCase/UseCaseInterface.php';

use src\Driver\RepositoryInterface;
use src\Entity\EntityInterface;

class Service implements UseCaseInterface
{

    private $repository;
    
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function read($query = null)
    {
        return $this->repository->read($query);
    }

    public function create(EntityInterface $entity)
    {
        return $this->repository->create($entity);
    }

    public function update(EntityInterface $entity, int $id)
    {
        return $this->repository->update($entity, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}


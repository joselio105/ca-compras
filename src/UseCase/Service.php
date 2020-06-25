<?php
namespace src\UseCase;

require_once 'src/UseCase/UseCaseInterface.php';

use src\Entity\Und;
use src\Driver\RepositoryInterface;

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

    public function create(Und $unidade)
    {
        return $this->repository->create($unidade);
    }

    public function update(Und $unidade, $id)
    {
        return $this->repository->update($unidade, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}


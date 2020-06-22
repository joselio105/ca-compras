<?php
namespace src\UseCase;

use src\Entity\Und;
use src\Driver\RepositoryInterface;

interface UseCaseInterface
{
    public function __construct(RepositoryInterface $repository);
    
    public function create(Und $unidade);
    
    public function read(string $query=null);
    
    public function update(Und $unidade, int $id);
    
    public function delete(int $id);
}


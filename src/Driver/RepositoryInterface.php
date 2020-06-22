<?php
namespace src\Driver;

use src\Entity\Und;

interface RepositoryInterface
{
    public function create(Und $und);
    
    public function read(string $query=null);
    
    public function update(Und $und, int $id);
    
    public function delete(int $id);
}


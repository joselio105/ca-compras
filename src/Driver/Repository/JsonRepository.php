<?php

declare(strict_types=1);

namespace src\Driver;

use src\Entity\EntityInterface;
use src\Entity\DbMysqlConfig;

class JsonRepository implements RepositoryInterface
{
    private $filename;
    
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function read($query = null)
    {
        $res = array();
        $string = '';
        
        if(file_exists($this->filename)){
            foreach (file($this->filename) as $line)
                $string.= $line;
        }
        if(strlen($string) > 0)
        {
            $res = json_decode($string, TRUE);            
        }
            
        
        return $res;
    }

    public function create(EntityInterface $entity)
    {}

    public function update(EntityInterface $entity, $id)
    {}

    public function delete($id)
    {}
}


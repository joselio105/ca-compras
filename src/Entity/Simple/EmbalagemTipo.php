<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

class EmbalagemTipo implements EntityInterface
{
    private $id;
    private $nome;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}


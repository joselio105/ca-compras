<?php
namespace src\Entity;

class PdtTp implements EntityInterface
{
    private $id;
    private $nome;
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
}


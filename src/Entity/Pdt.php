<?php
namespace src\Entity;

class Pdt implements EntityInterface
{
    private $id;
    private $nome;
    private $tipo;
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getTipo()
    {
        return $this->tipo;
    }
}


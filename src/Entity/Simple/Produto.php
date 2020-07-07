<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

class Produto implements EntityInterface
{
    private $id;
    private $nome;
    private $tipo;
    
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
}


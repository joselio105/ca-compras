<?php

declare(strict_types=1);

namespace src\Entity\Simple;

class Embalagem
{
    private $id;
    private $capacidade;
    private $unidade;
    private $tipo;
    
    public function getId()
    {
        return $this->id;
    }

    public function getCapacidade()
    {
        return $this->capacidade;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCapacidade($capacidade)
    {
        $this->capacidade = $capacidade;
    }

    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}


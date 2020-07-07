<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

class Embalagem implements EntityInterface
{
    private $id;
    private $capacidade;
    private $unidade;
    private $tipo;
    
    public function getTableName()
    {
        return 'lcp_emb';
    }
    
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


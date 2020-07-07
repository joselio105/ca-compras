<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

class Mercadoria implements EntityInterface
{
    private $id;
    private $produto;
    private $embalagem;
    
    public function getTableName()
    {
        return 'lcp_mcd';
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function getEmbalagem()
    {
        return $this->embalagem;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;
    }

    public function setEmbalagem($embalagem)
    {
        $this->embalagem = $embalagem;
    }
}


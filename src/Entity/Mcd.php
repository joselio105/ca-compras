<?php
namespace src\Entity;

class Mcd implements EntityInterface
{
    private $id;
    private $produto;
    private $embalagem;
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


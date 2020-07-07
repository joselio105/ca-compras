<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

class Historico implements EntityInterface
{
    private $id;
    private $mercadoria;
    private $quantidade;
    private $preco;
    private $data;
    
    public function getTableName()
    {
        return 'lcp_hst';
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getMercadoria()
    {
        return $this->mercadoria;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMercadoria($mercadoria)
    {
        $this->mercadoria = $mercadoria;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}

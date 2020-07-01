<?php

declare(strict_types=1);

namespace src\Entity;

class Historico extends Entity
{
    public $id;
    public $mercadoria;
    public $quantidade;
    public $preco;
    public $data;
    
    public function getTableName()
    {
        return 'lcp_hst';
    }
}


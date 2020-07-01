<?php

declare(strict_types=1);

namespace src\Entity;

class Mercadoria extends Entity
{
    public $id;
    public $produto;
    public $embalagem;
    
    public function getTableName()
    {
        return 'lcp_mcd';
    }
}


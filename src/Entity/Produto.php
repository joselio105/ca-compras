<?php

declare(strict_types=1);

namespace src\Entity;

class Produto extends Entity
{
    public $id;
    public $nome;
    public $tipo;
    
    public function getTableName()
    {
        return 'lcp_pdt';
    }
}


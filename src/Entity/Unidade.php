<?php

declare(strict_types=1);

namespace src\Entity;

class Unidade extends Entity
{
    public $id;
    public $nome;
    public $sigla;
    
    public function getTableName()
    {
        return 'lcp_und';
    }
}


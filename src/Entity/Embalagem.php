<?php

declare(strict_types=1);

namespace src\Entity;

class Embalagem extends Entity
{
    public $id;
    public $capacidade;
    public $unidade;
    public $tipo;
    
    public function getTableName()
    {
        return 'lcp_emb';
    }

}


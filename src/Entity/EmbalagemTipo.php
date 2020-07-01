<?php

declare(strict_types=1);

namespace src\Entity;

class EmbalagemTipo extends Entity
{
    public $id;
    public $nome;
    
    public function getTableName()
    {
        return 'lcp_emb_tp';
    }
}


<?php

declare(strict_types=1);

namespace src\Entity;

require_once 'src/Entity/Entity.php';

class ProdutoTipo extends Entity
{
    public $id;
    public $nome;
    
    public function getTableName()
    {
        return 'lcp_pdt_tp';
    }


}


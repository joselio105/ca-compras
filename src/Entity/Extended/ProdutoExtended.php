<?php

declare(strict_types=1);

namespace src\Entity\Extended;

use src\Entity\Simple\Produto;
use src\Entity\Simple\ProdutoTipo;

class ProdutoExtended extends Produto
{

    private $produtoTipo;
    
    public function __construct()
    {
        $this->produtoTipo = new ProdutoTipo();
    }
}


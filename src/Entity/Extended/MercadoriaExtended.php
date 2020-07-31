<?php

declare(strict_types=1);

namespace src\Entity\Extended;

use src\Entity\Simple\Mercadoria;

class MercadoriaExtended extends Mercadoria
{
    private $produto;
    private $embalagem;

    public function __construct()
    {
        $this->produto = new ProdutoExtended();
        $this->embalagem = new EmbalagemExtended();
    }
}


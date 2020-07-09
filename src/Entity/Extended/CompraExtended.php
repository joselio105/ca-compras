<?php

declare(strict_types=1);

namespace src\Entity\Extended;

use src\Entity\Simple\Compra;

class CompraExtended extends Compra
{
    private $mercadoria;

    public function __construct()
    {
        $this->mercadoria = new MercadoriaExtended();
    }
}


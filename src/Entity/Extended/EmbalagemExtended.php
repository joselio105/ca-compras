<?php

declare(strict_types=1);

namespace src\Entity\Extended;

use src\Entity\Simple\Embalagem;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\EmbalagemTipo;

class EmbalagemExtended extends Embalagem
{
    private $unidade;
    private $embalagemTipo;
    
    public function __construct()
    {
        $this->unidade = new Unidade();
        $this->embalagemTipo = new EmbalagemTipo();
    }
}


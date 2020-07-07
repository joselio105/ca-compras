<?php

declare(strict_types=1);

namespace src\Entity\Simple;

use src\Entity\EntityInterface;

require_once 'src/Entity/Entity.php';

class ProdutoTipo implements EntityInterface
{
    private $id;
    private $nome;
    
    public function getTableName()
    {
        return 'lcp_pdt_tp';
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}

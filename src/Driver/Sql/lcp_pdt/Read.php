<?php

namespace src\Driver\Sql\lcp_pdt;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\ProdutoTipo;
use src\Entity\Produto;

$sql = new SqlRead(new Produto());
$sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
$sql->setOrder('lcp_pdt.nome');

return $sql;

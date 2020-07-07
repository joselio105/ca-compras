<?php

namespace src\Driver\Sql\lcp_pdt;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Produto;

$sql = new SqlRead(new Produto());
$sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
$sql->setOrder('lcp_pdt.nome');

return $sql;

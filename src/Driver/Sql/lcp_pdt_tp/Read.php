<?php

namespace src\Driver\Sql\lcp_pdt_tp;

require_once 'libs/Sql/SqlRead.php';

use src\Entity\ProdutoTipo;
use libs\Sql\SqlRead;

$sql = new SqlRead(new ProdutoTipo());
$sql->setOrder('nome');

return $sql;
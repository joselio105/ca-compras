<?php

namespace src\Driver\Sql\produto_tipo;

require_once 'libs/Sql/SqlRead.php';

use src\Entity\Simple\ProdutoTipo;
use libs\Sql\SqlRead;

$sql = new SqlRead(new ProdutoTipo());
$sql->setOrder('nome');

return $sql;
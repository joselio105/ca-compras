<?php

namespace src\Driver\Sql\produto;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Produto;

$sql = new SqlRead(new Produto());
$sql->setJoin(new ProdutoTipo(), "produto.tipo=produto_tipo.id");
$sql->setOrder('produto.nome');

return $sql;

<?php

namespace src\Driver\Sql\produto;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Produto;
use src\Entity\EntityFactory;

$entity = new EntityFactory(new Produto());
$sql = new SqlRead($entity);

$sql->setJoin(new ProdutoTipo(), "produto.tipo=produto_tipo.id");
$sql->setOrder('produto.nome');

return $sql;

<?php

namespace src\Driver\Sql\produto_tipo;

require_once 'libs/Sql/SqlRead.php';

use src\Entity\Simple\ProdutoTipo;
use libs\Sql\SqlRead;
use src\Entity\EntityFactory;

$entity = new EntityFactory(new ProdutoTipo());
$sql = new SqlRead($entity);
$sql->setOrder('nome');

return $sql;
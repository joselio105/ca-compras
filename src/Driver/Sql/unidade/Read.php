<?php

namespace src\Driver\Sql\unidade;

require_once 'libs/Sql/SqlRead.php';

use src\Entity\Simple\Unidade;
use libs\Sql\SqlRead;
use src\Entity\EntityFactory;

$entity = new EntityFactory(new Unidade());
$sql = new SqlRead($entity);
$sql->setOrder('nome');

return $sql;

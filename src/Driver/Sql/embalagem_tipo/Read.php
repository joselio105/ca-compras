<?php

namespace src\Driver\Sql\embalagem_tipo;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\EmbalagemTipo;

$sql = new SqlRead(new EmbalagemTipo());
$sql->setOrder('nome');

return $sql;

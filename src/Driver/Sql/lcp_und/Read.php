<?php

namespace src\Driver\Sql\lcp_und;

require_once 'libs/Sql/SqlRead.php';

use src\Entity\Simple\Unidade;
use libs\Sql\SqlRead;

$sql = new SqlRead(new Unidade());
$sql->setOrder('nome');

return $sql;

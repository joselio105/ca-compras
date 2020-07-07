<?php

namespace src\Driver\Sql\lcp_emb_tp;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\EmbalagemTipo;

$sql = new SqlRead(new EmbalagemTipo());
$sql->setOrder('nome');

return $sql;

<?php

namespace src\Driver\Sql\lcp_emb;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Embalagem;
use src\Entity\Unidade;
use src\Entity\EmbalagemTipo;

$sql = new SqlRead(new Embalagem());
$sql->setJoin(new Unidade(), "lcp_emb.unidade=lcp_und.id");
$sql->setJoin(new EmbalagemTipo(), "lcp_emb.tipo=lcp_emb_tp.id");
$sql->setOrder('lcp_emb_tp.nome');

return $sql;

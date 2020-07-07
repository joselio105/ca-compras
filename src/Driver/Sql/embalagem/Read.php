<?php

namespace src\Driver\Sql\embalagem;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\Embalagem;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\EmbalagemTipo;

$sql = new SqlRead(new Embalagem());
$sql->setJoin(new Unidade(), "embalagem.unidade=unidade.id");
$sql->setJoin(new EmbalagemTipo(), "embalagem.tipo=embalagem_tipo.id");
$sql->setOrder('embalagem_tipo.nome');

return $sql;

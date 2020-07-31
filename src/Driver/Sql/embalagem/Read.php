<?php

namespace src\Driver\Sql\embalagem;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\EmbalagemTipo;
use src\Entity\Simple\Embalagem;
use src\Entity\EntityFactory;

$entity = new EntityFactory(new Embalagem());
$sql = new SqlRead($entity);

//$sql->setJoin(new EntityFactory(new Unidade()), "embalagem.unidade=unidade.id");
//$sql->setJoin(new EntityFactory(new EmbalagemTipo()), "embalagem.tipo=embalagem_tipo.id");
//$sql->setOrder('embalagem_tipo.nome');

return $sql;

<?php

namespace src\Driver\Sql\compra;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\Mercadoria;
use src\Entity\Simple\Produto;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Embalagem;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\EmbalagemTipo;
use src\Entity\Simple\Compra;

$sql = new SqlRead(new Compra());
$sql->setJoin(new Mercadoria(), "compra.mercadoria=mercadoria.id");
$sql->setJoin(new Produto(), "mercadoria.produto=produto.id");
$sql->setJoin(new ProdutoTipo(), "produto.tipo=produto_tipo.id");
$sql->setJoin(new Embalagem(), "mercadoria.embalagem=embalagem.id");
$sql->setJoin(new Unidade(), "embalagem.unidade=unidade.id");
$sql->setJoin(new EmbalagemTipo(), "embalagem.tipo=embalagem_tipo.id");
$sql->setConcat(array(
    'produto.nome',
    'embalagem_tipo.nome',
    'embalagem.capacidade',
    'unidade.sigla'
), 'mcdNome');
$sql->setOrder('mcdNome');

return $sql;

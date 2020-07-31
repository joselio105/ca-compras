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
use src\Entity\EntityFactory;

$entity = new EntityFactory(new Compra());
$sql = new SqlRead($entity);

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

$subQueries['soma'] = new SqlRead(new Compra());
$subQueries['soma']->setSum('compra.preco');
$subQueries['soma']->setWhere("compra.mercadoria=mercadoria.id");

$subQueries['conta'] = new SqlRead(new Compra());
$subQueries['conta']->setCount();
$subQueries['conta']->setWhere("compra.mercadoria=mercadoria.id");

foreach ($subQueries as $label=>$subQuery)
    $sql->setSubQuery($subQuery, $label);

return $sql;

<?php

namespace src\Driver\Sql\mercadoria;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Simple\EmbalagemTipo;
use src\Entity\Simple\Produto;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Embalagem;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\Mercadoria;
use src\Entity\Simple\Compra;
use src\Entity\EntityFactory;

$entity = new EntityFactory(new Mercadoria());
$sql = new SqlRead($entity);

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

$subQuery['lastBuy'] = new SqlRead(new Compra());
$subQuery['lastBuy']->setOrder('data', true);
$subQuery['lastBuy']->setLimit(1);
$subQuery['lastBuy']->showField('compra.data');
$subQuery['lastBuy']->setWhere('compra.mercadoria=mercadoria.id');

$subQuery['lastPay'] = new SqlRead(new Compra());
$subQuery['lastPay']->setOrder('preco', true);
$subQuery['lastPay']->setLimit(1);
$subQuery['lastPay']->showField('compra.preco');
$subQuery['lastPay']->setWhere('compra.mercadoria=mercadoria.id');

foreach ($subQuery as $alias=>$query)
    $sql->setSubQuery($query->__toString(), $alias);

return $sql;

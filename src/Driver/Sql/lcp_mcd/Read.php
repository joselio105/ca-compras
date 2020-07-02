<?php

namespace src\Driver\Sql\lcp_mcd;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\EmbalagemTipo;
use src\Entity\Produto;
use src\Entity\ProdutoTipo;
use src\Entity\Embalagem;
use src\Entity\Unidade;
use src\Entity\Mercadoria;
use src\Entity\Historico;

$sql = new SqlRead(new Mercadoria());
$sql->setJoin(new Produto(), "lcp_mcd.produto=lcp_pdt.id");
$sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
$sql->setJoin(new Embalagem(), "lcp_mcd.embalagem=lcp_emb.id");
$sql->setJoin(new Unidade(), "lcp_emb.unidade=lcp_und.id");
$sql->setJoin(new EmbalagemTipo(), "lcp_emb.tipo=lcp_emb_tp.id");
$sql->setConcat(array(
    'lcp_pdt.nome',
    'lcp_emb_tp.nome',
    'lcp_emb.capacidade',
    'lcp_und.sigla'
), 'mcdNome');
$sql->setOrder('mcdNome');

$subQuery['lastBuy'] = new SqlRead(new Historico());
$subQuery['lastBuy']->setOrder('data', true);
$subQuery['lastBuy']->setLimit(1);
$subQuery['lastBuy']->showField('lcp_hst.data');
$subQuery['lastBuy']->setWhere('lcp_hst.mercadoria=lcp_mcd.id');

$subQuery['lastPay'] = new SqlRead(new Historico());
$subQuery['lastPay']->setOrder('preco', true);
$subQuery['lastPay']->setLimit(1);
$subQuery['lastPay']->showField('lcp_hst.preco');
$subQuery['lastPay']->setWhere('lcp_hst.mercadoria=lcp_mcd.id');

foreach ($subQuery as $alias=>$query)
    $sql->setSubQuery($query->__toString(), $alias);

return $sql;

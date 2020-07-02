<?php

namespace src\Driver\Sql\lcp_hst;

require_once 'libs/Sql/SqlRead.php';

use libs\Sql\SqlRead;
use src\Entity\Historico;
use src\Entity\Mercadoria;
use src\Entity\Produto;
use src\Entity\ProdutoTipo;
use src\Entity\Embalagem;
use src\Entity\Unidade;
use src\Entity\EmbalagemTipo;

$sql = new SqlRead(new Historico());
$sql->setJoin(new Mercadoria(), "lcp_hst.mercadoria=lcp_mcd.id");
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

return $sql;

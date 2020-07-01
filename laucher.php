<?php

declare(strict_types=1);

require_once 'src/Controller/IndexHandler.php';
require_once 'src/Controller/HandlerFactory.php';
require_once 'src/Driver/MysqlConnData.php';
foreach (glob("src/Entity/*.php") as $file)
{
    require_once $file;
}

use src\Controller\IndexHandler;
use src\Controller\HandlerFactory;
use src\Driver\MysqlConnData;
use src\Entity\Unidade;
use src\Entity\ProdutoTipo;
use src\Entity\Produto;
use src\Entity\Mercadoria;
use src\Entity\Embalagem;
use src\Entity\EmbalagemTipo;
use src\Entity\Historico;

$params = array();
$queryString = $_SERVER['QUERY_STRING'];
foreach(explode('&', $queryString) as $slice){
    $part = explode('=', $slice);
    $params[$part[0]] = $part[1];
}
$params['ctlr'] = (key_exists('ctlr', $params) ? $params['ctlr'] : 'read');
$entities = array(
    'und'=>Unidade::class,
    'pdt_tp'=>ProdutoTipo::class,
    'pdt'=>Produto::class,
    'mcd'=>Mercadoria::class,
    'emb'=>Embalagem::class,
    'emb_tp'=>EmbalagemTipo::class,
    'hst'=>Historico::class
);
$entity = new $entities[$params['ent']];

echo "<h2>{$params['ent']}/ {$params['ctlr']}</h2>";

$invoke = new HandlerFactory();
echo $invoke(new MysqlConnData($entity), IndexHandler::class);

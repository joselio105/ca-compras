<?php

declare(strict_types=1);

require_once 'src/Controller/IndexHandler.php';
require_once 'src/Controller/HandlerFactory.php';
require_once 'src/Driver/Repository/MysqlConnData.php';
foreach (glob("src/Entity/*.php") as $file)
{
    require_once $file;
}
foreach (glob("src/Entity/Simple/*.php") as $file)
{
    require_once $file;
}

use src\Controller\IndexHandler;
use src\Controller\HandlerFactory;
use src\Driver\Repository\MysqlConnData;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Produto;
use src\Entity\Simple\Mercadoria;
use src\Entity\Simple\Embalagem;
use src\Entity\Simple\EmbalagemTipo;
use src\Entity\Simple\Compra;

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
    'hst'=>Compra::class
);
$entity = new $entities[$params['ent']];

echo "<h2>{$params['ent']}/ {$params['ctlr']}</h2>";

$invoke = new HandlerFactory();
echo $invoke(new MysqlConnData($entity), IndexHandler::class);

<?php

declare(strict_types=1);

require_once 'src/Controller/IndexHandler.php';
require_once 'src/Controller/HandlerFactory.php';
require_once 'src/Driver/MysqlConnData.php';

use src\Controller\IndexHandler;
use src\Controller\HandlerFactory;
use src\Driver\MysqlConnData;

$params = array();
$queryString = $_SERVER['QUERY_STRING'];
foreach(explode('&', $queryString) as $slice){
    $part = explode('=', $slice);
    $params[$part[0]] = $part[1];
}
$params['ctlr'] = (key_exists('ctlr', $params) ? $params['ctlr'] : 'read');
echo "<h2>{$params['ent']}/ {$params['ctlr']}</h2>";

$invoke = new HandlerFactory();
echo $invoke(new MysqlConnData(), IndexHandler::class);

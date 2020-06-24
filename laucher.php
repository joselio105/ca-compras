<?php
include_once 'src/Controller/IndexHandler.php';
include_once 'src/Driver/RepositoryInterface.php';
include_once 'src/Driver/MysqlRepository.php';
include_once 'src/UseCase/Service.php';

use src\Controller\IndexHandler;
use src\Driver\MysqlRepository;
use src\UseCase\Service;

$dsn = "mysql:dbname=compras;host=localhost";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

$conn = new PDO($dsn, 'root', '', $options);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$repository = new MysqlRepository($conn);
$service = new Service($repository);

$params = array();
$queryString = $_SERVER['QUERY_STRING'];
foreach(explode('&', $queryString) as $slice){
    $part = explode('=', $slice);
    $params[$part[0]] = $part[1];
}
echo "<h2>{$params['ctlr']}</h2>";

$ctrl = new IndexHandler($service);
$ctrl->handle();
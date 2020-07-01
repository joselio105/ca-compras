<?php

declare(strict_types=1);

namespace src\Controller;

require_once 'src/UseCase/Service.php';
require_once 'src/Driver/MysqlRepository.php';
require_once 'libs/Html/HtmlTagTable.php';

use Psr\Container\ContainerInterface;
use src\Driver\MysqlRepository;
use src\UseCase\Service;
use libs\Html\HtmlTagTable;

class HandlerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $repo = $container->get(MysqlRepository::class);
        
        $servive = new Service($repo);        
        $ctrl = new $requestedName($servive);
        
        $response = array();
        foreach ($servive->read() as $i=>$line)
        {
            $response[$i]['Unidade'] = $line->getNome();
            $response[$i]['Sigla'] = $line->getSigla();
        }
        
        return $ctrl->handle(new HtmlTagTable('table', $response));
    }
}


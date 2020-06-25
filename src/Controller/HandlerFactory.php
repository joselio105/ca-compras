<?php

declare(strict_types=1);

namespace src\Controller;

require_once 'src/UseCase/Service.php';
require_once 'src/Driver/MysqlRepository.php';

use Psr\Container\ContainerInterface;
use src\Driver\MysqlRepository;
use src\UseCase\Service;

class HandlerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $repo = $container->get(MysqlRepository::class);
        $servive = new Service($repo);        
        $ctrl = new $requestedName($servive);
        
        return $ctrl->handle();
    }
}


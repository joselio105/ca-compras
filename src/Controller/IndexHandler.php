<?php
namespace src\Controller;

use src\UseCase\UseCaseInterface;

class IndexHandler
{
    private $service;

    public function __construct(UseCaseInterface $service)
    {
        $this->service = $service;
    }
    
    public function handle(){
        var_dump($this->service->read());die;
    }
}


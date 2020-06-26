<?php

declare(strict_types=1);

namespace src\Controller;

use src\UseCase\UseCaseInterface;
use libs\Html\HtmlTagsInterface;

class IndexHandler
{
    private $service;

    public function __construct(UseCaseInterface $service)
    {
        $this->service = $service;
    }
    
    public function handle(HtmlTagsInterface $htmlCode)
    {        
        return $htmlCode;
    }
}


<?php

namespace Agro\System;

use Exception;
use Agro\Router\IRouter;

class Agro
{
    /** @var IRouter */
    private IProvider $router;

    /** @throws Exception */
    public function __construct()
    {
        $this->router = Provider::get(DefaultProviders::ROUTER->value);
        $this->router->getController()
            ->setView(Provider::get(DefaultProviders::VIEW->value))
            ->setRouter($this->router)
            ->initAction();
    }
}

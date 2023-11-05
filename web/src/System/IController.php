<?php

namespace Agro\System;

use Agro\Router\IRouter;
use Agro\View\IView;

interface IController
{
    /** @param IView $view */
    public function setView(IProvider $view): self;

    /** @param IRouter $router */
    public function setRouter(IProvider $router): self;

    /** @return IView */
    public function view(): IProvider;

    /** @return IRouter */
    public function router(): IProvider;
}

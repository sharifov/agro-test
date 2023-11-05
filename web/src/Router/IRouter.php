<?php

namespace Agro\Router;

use Agro\System\IController;
use Agro\System\IProvider;

interface IRouter extends IProvider
{
    public function getController(): IController;

    public function getControllerName(): string;

    public function getControllerNameWithoutPostfix(): string;

    public function getActionName(): string;

    /** @return string[] */
    public function getParams(): array;
}

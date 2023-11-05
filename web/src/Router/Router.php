<?php

namespace Agro\Router;

use Agro\System\IController;
use InvalidArgumentException;

class Router implements IRouter
{
    /** @var string */
    private const DEFAULT_CONTROLLER = 'Start';

    /** @var string */
    private const DEFAULT_ACTION = 'Index';

    /** @var string */
    private const CONTROLLER_POSTFIX = 'Controller';

    /** @var string */
    private const CONTROLLER_NAMESPACE = 'Agro\\Controllers\\';

    private string $controllerName;

    private string $controllerNameWithoutPostfix;

    private string $actionName;

    /** @var string[] */
    private array $params = [];

    private IController $controller;

    public function __construct()
    {
        $routes = explode('/', str_replace(
            ['?', $_SERVER['QUERY_STRING']],
            '',
            trim($_SERVER['REQUEST_URI'], '/')
        ));
        if (empty($routes[0])) {
            $routes[0] = self::DEFAULT_CONTROLLER;
        }
        $this->controllerNameWithoutPostfix = strtolower($routes[0]);
        $this->controllerName = ucfirst($this->controllerNameWithoutPostfix) . self::CONTROLLER_POSTFIX;
        if (empty($routes[1])) {
            $routes[1] = self::DEFAULT_ACTION;
        }
        $controllerClass = self::CONTROLLER_NAMESPACE . $this->controllerName;
        if (!class_exists($controllerClass)) {
            throw new InvalidArgumentException("Невозможно найти контроллер - $controllerClass!");
        }
        $this->actionName = strtolower($routes[1]);
        if (!method_exists($controllerClass, $this->actionName)) {
            throw new InvalidArgumentException(
                "Невозможно метода - $this->actionName в контроллере - $controllerClass!"
            );
        }
        if (count($routes) > 2) {
            $this->params = array_slice($routes, 2);
        }
        $this->controller = new $controllerClass();
    }

    public function getController(): IController
    {
        return $this->controller;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function getControllerNameWithoutPostfix(): string
    {
        return $this->controllerNameWithoutPostfix;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    /** @inheritdoc */
    public function getParams(): array
    {
        return $this->params;
    }
}

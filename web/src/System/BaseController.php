<?php

namespace Agro\System;

use Agro\Router\IRouter;
use Agro\View\IView;
use InvalidArgumentException;

class BaseController implements IController
{
    private IView $view;

    private IRouter $router;

    private IFakeData $fakeData;

    public function initAction(): void
    {
        if (method_exists($this, $this->router->getActionName())) {
            $this->defaultInit();
            call_user_func_array(
                [
                    $this,
                    $this->router->getActionName()
                ],
                $this->router->getParams()
            );
        } else {
            throw new InvalidArgumentException('Нет указанного метода в контроллер!');
        }
    }

    public function getFakeData(): IFakeData
    {
        return $this->fakeData;
    }

    /** @inheritdoc */
    public function setView(IProvider $view): self
    {
        $this->view = $view;

        return $this;
    }

    /** @inheritdoc */
    public function setRouter(IProvider $router): self
    {
        $this->router = $router;

        return $this;
    }

    public function setFakeData(IFakeData $fakeData): void
    {
        $this->fakeData = $fakeData;
    }

    /** @inheritdoc */
    public function view(): IProvider
    {
        return $this->view;
    }

    /** @inheritdoc */
    public function router(): IProvider
    {
        return $this->router;
    }

    private function defaultInit(): void
    {
        $this->setFakeData(new FakeData());
        $this->view()->setFolder(
            $this->router->getControllerNameWithoutPostfix(),
            $this->router->getActionName()
        );
    }
}

<?php

namespace Agro\View;

use Agro\System\IProvider;

interface IView extends IProvider
{
    /**
     * Render template
     * @param array[] $data
     */
    public function render(array $data = []): void;

    public function getFolder(): string;

    public function setFolder(string $controller, string $action): void;

    public function getError(): string;

    public function setError(string $error): void;

    public function hasError(): bool;
}

<?php

namespace Agro\View;

use InvalidArgumentException;

class View implements IView
{
    private string $folder;

    private string $error = '';

    /** @inheritdoc */
    public function render(array $data = []): void
    {
        if ($data !== []) {
            extract($data);
        }
        require_once $this->getFolder();
    }

    public function getFolder(): string
    {
        return $this->folder;
    }

    public function setFolder(string $controller, string $action): void
    {
        $folder = TEMPLATE_DIR . $controller . '/' . $action . '.php';
        if (!file_exists($folder)) {
            throw new InvalidArgumentException("Невозможно найти шаблона - $folder!");
        }
        $this->folder = $folder;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }

    public function hasError(): bool
    {
        return $this->error !== '';
    }
}

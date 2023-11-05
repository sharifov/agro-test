<?php

namespace Agro\Services;

use Agro\Exceptions\TaxException;

class TaxParseService
{
    /** @var string */
    public const DEFAULT_PATTERN = '#^([A-Z]{2})[0-9].+#';

    private string $taxNumber;

    private string $pattern;

    /**
     * Get country code from string
     * @throws TaxException
     */
    public function parse(): string
    {
        if ('' === $this->pattern) {
            throw new TaxException('Не установлен паттерн!');
        }
        if (!preg_match($this->pattern, $this->taxNumber, $matches)) {
            throw new TaxException('Невалидный формат для Tax номера!');
        }

        return $matches[1];
    }

    public function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }

    public function setPattern(string $pattern): void
    {
        $this->pattern = $pattern;
    }
}

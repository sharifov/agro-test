<?php

namespace Agro\Services;

use Agro\Entities\CountryEntity;
use Agro\Entities\ProductEntity;
use NumberFormatter;

class CalculateService
{
    /** @var string */
    private const MONEY_LOCALE = 'de_DE';

    private float $calculatedSum;

    public function __construct(
        private readonly ProductEntity $product,
        private readonly CountryEntity $country
    ) {
    }

    public function calculate(): void
    {
        $this->calculatedSum = $this->getProduct()->getPrice()
            + ($this->getProduct()->getPrice()  * $this->getCountry()->getTaxPercent() / 100);
    }

    public function getMoneyFormat(): string
    {
        $numberFormat = new NumberFormatter(self::MONEY_LOCALE, NumberFormatter::CURRENCY);

        return $numberFormat->format($this->calculatedSum);
    }

    public function getProduct(): ProductEntity
    {
        return $this->product;
    }

    public function getCountry(): CountryEntity
    {
        return $this->country;
    }

    public function getCalculatedSum(): float
    {
        return $this->calculatedSum;
    }
}

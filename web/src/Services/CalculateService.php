<?php

namespace Agro\Services;

use Agro\Entities\ICountryEntity;
use Agro\Entities\IProductEntity;
use NumberFormatter;

class CalculateService
{
    /** @var string */
    private const MONEY_LOCALE = 'de_DE';

    private float $calculatedSum;

    public function __construct(
        private readonly IProductEntity $product,
        private readonly ICountryEntity $country
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

    public function getProduct(): IProductEntity
    {
        return $this->product;
    }

    public function getCountry(): ICountryEntity
    {
        return $this->country;
    }

    public function getCalculatedSum(): float
    {
        return $this->calculatedSum;
    }
}

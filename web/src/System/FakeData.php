<?php

namespace Agro\System;

use Agro\Entities\CountryEntity;
use Agro\Entities\ProductEntity;
use InvalidArgumentException;

class FakeData implements IFakeData
{
    /** @var ProductEntity[] */
    private array $products;

    /** @var CountryEntity[] */
    private array $countries;

    public function __construct()
    {
        $this->initProducts();
        $this->initCountries();
    }

    /** @inheritdoc */
    public function getProducts(): array
    {
        return $this->products;
    }

    /** @inheritdoc */
    public function getCountries(): array
    {
        return $this->countries;
    }

    public function getCountryByCode(string $code): CountryEntity
    {
        if ('' === $code) {
            throw new InvalidArgumentException('Код страны пустой!');
        }

        $countries = array_filter(
            $this->getCountries(),
            fn(CountryEntity $country) => $code === $country->getCode()
        );

        if ([] === $countries) {
            throw new InvalidArgumentException('Нет страны с таким кодом!');
        }

        return end($countries);
    }

    public function getProductById(int $productId): ProductEntity
    {
        $products = array_filter(
            $this->getProducts(),
            fn(ProductEntity $product) => $productId === $product->getId()
        );

        if ([] === $products) {
            throw new InvalidArgumentException('Нет товара с таким ИД номером!');
        }

        return end($products);
    }

    private function initProducts(): void
    {
        $product1 = new ProductEntity();
        $product1->setId(1);
        $product1->setTitle('Наушники');
        $product1->setPrice(100);

        $product2 = new ProductEntity();
        $product2->setId(2);
        $product2->setTitle('Чехол');
        $product2->setPrice(20);

        $this->products = [$product1, $product2];
    }

    private function initCountries(): void
    {
        $country1 = new CountryEntity();
        $country1->setId(1);
        $country1->setCode('DE');
        $country1->setName('Германия');
        $country1->setTaxPercent(19);

        $country2 = new CountryEntity();
        $country2->setId(2);
        $country2->setCode('IT');
        $country2->setName('Италия');
        $country2->setTaxPercent(22);

        $country3 = new CountryEntity();
        $country3->setId(3);
        $country3->setCode('GR');
        $country3->setName('Греция');
        $country3->setTaxPercent(24);

        $this->countries = [$country1, $country2, $country3];
    }
}

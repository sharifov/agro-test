<?php

namespace AgroTest;

use Agro\Entities\CountryEntity;
use Agro\Entities\ProductEntity;
use Agro\Services\CalculateService;
use PHPUnit\Framework\TestCase;

class CalculateServiceTest extends TestCase
{
    /** @dataProvider getDummyData */
    public function testCalculate(float $price, int $percent, float $excepted): void
    {
        $product = new ProductEntity();
        $product->setPrice($price);

        $country = new CountryEntity();
        $country->setTaxPercent($percent);

        $calculateService = new CalculateService($product, $country);
        $calculateService->calculate();

        $this->assertEquals($excepted, $calculateService->getCalculatedSum());
    }

    /** @return array[] */
    public static function getDummyData(): array
    {
        return [
            [50, 13, 56.50]
        ];
    }
}


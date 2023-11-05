<?php

namespace Agro\System;

use Agro\Entities\CountryEntity;
use Agro\Entities\ProductEntity;

interface IFakeData
{
    /** @return ProductEntity[] */
    public function getProducts(): array;

    /** @return CountryEntity[] */
    public function getCountries(): array;
}

<?php

namespace Agro\Entities;

interface ICountryEntity
{
    public function getId(): int;

    public function getName(): string;

    public function getTaxPercent(): int;

    public function getCode(): string;

    public function setId(int $id): void;

    public function setName(string $name): void;

    public function setTaxPercent(int $taxPercent): void;

    public function setCode(string $code): void;
}

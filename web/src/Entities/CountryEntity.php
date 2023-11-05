<?php

namespace Agro\Entities;

class CountryEntity
{
    private int $id;

    private string $name;

    private int $taxPercent;

    private string $code;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTaxPercent(): int
    {
        return $this->taxPercent;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setTaxPercent(int $taxPercent): void
    {
        $this->taxPercent = $taxPercent;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}

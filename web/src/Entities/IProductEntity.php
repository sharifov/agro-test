<?php

namespace Agro\Entities;

interface IProductEntity
{
    public function getId(): int;

    public function getTitle(): string;

    public function getPrice(): float;

    public function setId(int $id): void;

    public function setTitle(string $title): void;

    public function setPrice(float $price): void;
}

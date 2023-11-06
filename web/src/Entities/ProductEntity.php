<?php

namespace Agro\Entities;

class ProductEntity implements IProductEntity
{
    private int $id;

    private string $title;

    private float $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}

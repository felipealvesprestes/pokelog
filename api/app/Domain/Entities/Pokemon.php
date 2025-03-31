<?php

namespace App\Domain\Entities;

class Pokemon
{
    public function __construct(
        private ?int $id,
        private string $name,
        private array $types,
        private float $weight,
        private float $height,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWeightInKilograms(): float
    {
        return $this->getWeight() / 10;
    }

    public function getHeightInCentimeters(): float
    {
        return $this->getHeight() * 100;
    }
}

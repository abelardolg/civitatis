<?php

namespace App\CivitatisSoftware\Activity\Domain;

final class ActivityList
{
    private int $id;
    private string $title;
    private float $totalPrice;
    private int $numPax;

    public function __construct(int $id, string $title, float $totalPrice, int $numPax)
    {
        $this->id = $id;
        $this->title = $title;
        $this->totalPrice = $totalPrice;
        $this->numPax = $numPax;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getNumPax(): int
    {
        return $this->numPax;
    }
}

<?php

namespace App\CivitatisSoftware\Activity\Domain;

use DateTime;

final class ActivityDetail
{
    private string $title;
    private string $description;
    private DateTime $date;
    private float $totalPrice;
    private int $numPax;
    private array $relatedActivities;

    public function __construct(string $title, string $description, Datetime $date, float $totalPrice, int $numPax, array $relatedActivities)
    {
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->totalPrice = $totalPrice;
        $this->numPax = $numPax;
        $this->relatedActivities = $relatedActivities;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getRelatedActivities(): array
    {
        return $this->relatedActivities;
    }
}

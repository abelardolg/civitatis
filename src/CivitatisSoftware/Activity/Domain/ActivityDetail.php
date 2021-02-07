<?php

namespace App\CivitatisSoftware\Activity\Domain;

use App\CivitatisSoftware\Shared\valueObjects\NonEmptyString;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateTime;

final class ActivityDetail
{
    private NonEmptyString $title;
    private NonEmptyString $description;
    private DateTime $date;
    private Price $totalPrice;
    private NumPax $numPax;
    private array $relatedActivities;

    public function __construct(NonEmptyString $title, NonEmptyString $description, Datetime $date, Price $totalPrice, NumPax $numPax, array $relatedActivities)
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
        return $this->title->getValue();
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice->getValue();
    }

    public function getNumPax(): int
    {
        return $this->numPax->getValue();
    }

    public function getDescription(): string
    {
        return $this->description->getValue();
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

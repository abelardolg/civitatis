<?php

namespace App\CivitatisSoftware\Activity\Domain;

use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\valueObjects\NonEmptyString;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;

class ActivityList
{
    private ID $id;
    private NonEmptyString $title;
    private Price $totalPrice;
    private NumPax $numPax;

    public function __construct(ID $id, NonEmptyString $title, Price $totalPrice, NumPax $numPax)
    {
        $this->setID($id);
        $this->title = $title;
        $this->totalPrice = $totalPrice;
        $this->numPax = $numPax;
    }

    public function getId(): int
    {
        return $this->id->getValue();
    }

    private function setID(ID $id): void
    {
        $this->id = $id;
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
}

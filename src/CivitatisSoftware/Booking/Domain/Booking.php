<?php

namespace App\CivitatisSoftware\Booking\Domain;

use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateTime;
use InvalidArgumentException;

class Booking
{
    private ID $id;

    private ID $activity_id;
    private NumPax $numPax;
    private Price $price;
    private DateTime $bookDate;
    private DateTime $doneDate;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(ID $activityID, NumPax $numPax, Price $price, DateTime $bookDate, DateTime $doneDate)
    {
        $this->setActivityID($activityID);
        $this->setNumPax($numPax);
        $this->setPrice($price);
        $this->setBookDate($bookDate);
        $this->setDoneDate($doneDate);

        $this->createdAt = new DateTime();
        $this->markAsUpdated();
    }

    public function getActivityId(): int
    {
        return $this->activity_id->getValue();
    }

    private function setPrice(Price $price): void
    {
        $this->price = $price;
    }

    private function setBookDate(DateTime $bookDate): void
    {
        $hoy = new DateTime();
        if ($bookDate < $hoy) {
            throw new InvalidArgumentException('La fecha de la reserva no puede ser antes de la fecha de hoy');
        }
        $this->bookDate = $bookDate;
    }

    private function setDoneDate(DateTime $doneDate): void
    {
        $hoy = new DateTime();
        if ($doneDate < $hoy) {
            throw new InvalidArgumentException('La fecha de finalización de la reserva no puede ser antes de la fecha de hoy');
        }
        if ($doneDate < $this->getBookDate()) {
            throw new InvalidArgumentException('La fecha de finalización de la reserva no puede ser antes de su creación');
        }
        $this->doneDate = $doneDate;
    }

    public function getBookDate(): DateTime
    {
        return $this->bookDate;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id->getValue();
    }

    public function getNumPax(): int
    {
        return $this->numPax->getValue();
    }

    private function setNumPax(NumPax $numPax): void
    {
        $this->numPax = $numPax;
    }

    public function getPrice(): float
    {
        return $this->price->getValue();
    }

    public function getDoneDate(): DateTime
    {
        return $this->doneDate;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    private function setActivityID(ID $activityID): void
    {
        $this->activity_id = $activityID;
    }
}

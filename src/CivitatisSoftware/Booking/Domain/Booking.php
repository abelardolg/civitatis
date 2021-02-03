<?php

namespace App\CivitatisSoftware\Booking\Domain;

use DateTime;
use InvalidArgumentException;

final class Booking
{
    private int $id;

    private int $activity_id;
    private int $numPax;
    private float $price;
    private DateTime $bookDate;
    private DateTime $doneDate;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $activityID, int $numPax, float $price, DateTime $bookDate, DateTime $doneDate)
    {
        $this->activity_id = $activityID;
        $this->setNumPax($numPax);
        $this->setPrice($price);
        $this->setBookDate($bookDate);
        $this->setDoneDate($doneDate);

        $this->createdAt = new DateTime();
        $this->markAsUpdated();
    }

    public function getActivityId(): int
    {
        return $this->activity_id;
    }

    private function setPrice(float $price): void
    {
        if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
            throw new InvalidArgumentException('El precio de la reserva debe estar reflejado con valores decimales (Ej. 34.0 €)');
        }
        if ($price < 0) {
            throw new InvalidArgumentException('El precio de la reserva no puede ser negativo');
        }

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
        return $this->id;
    }

    public function getNumPax(): int
    {
        return $this->numPax;
    }

    public function setNumPax(int $numPax): void
    {
        if ($numPax < 1) {
            throw new InvalidArgumentException('La reserva ha de tener al menos 1 persona.');
        }

        $this->numPax = $numPax;
    }

    public function getPrice(): float
    {
        return $this->price;
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
}

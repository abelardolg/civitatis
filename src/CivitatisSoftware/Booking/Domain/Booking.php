<?php

namespace App\CivitatisSoftware\Booking\Domain;

use DateTimeImmutable;
use InvalidArgumentException;

final class Booking
{
    protected int $activityID;
    protected int $numPax;
    protected float $price;
    protected DateTimeImmutable $bookDate;
    protected DateTimeImmutable $doneDate;
    protected DateTimeImmutable $createdAt;
    protected DateTimeImmutable $updatedAt;
    private int $id;

    public function __construct(int $id, int $activityID, int $numPax, float $price, DateTimeImmutable $bookDate, DateTimeImmutable $doneDate)
    {
        $this->id = $id;
        $this->activityID = $activityID;
        $this->setNumPax($numPax);
        $this->setPrice($price);
        $this->setBookDate($bookDate);
        $this->setDoneDate($doneDate);

        $this->createdAt = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    /**
     * @param float $price
     */
    private function setPrice(float $price): void
    {
        if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
            throw new InvalidArgumentException("El precio de la reserva debe estar reflejado con valores decimales (Ej. 34.0 €)");
        }
        if ($price < 0) {
            throw new InvalidArgumentException("El precio de la reserva no puede ser negativo");
        }

        $this->price = $price;
    }

    /**
     * @param DateTimeImmutable $bookDate
     */
    private function setBookDate(DateTimeImmutable $bookDate): void
    {
        $hoy = new DateTimeImmutable();
        if ($bookDate < $hoy) {
            throw new InvalidArgumentException("La fecha de la reserva no puede ser antes de la fecha de hoy");
        }
        $this->bookDate = $bookDate;
    }

    /**
     * @param DateTimeImmutable $doneDate
     */
    private function setDoneDate(DateTimeImmutable $doneDate): void
    {
        $hoy = new DateTimeImmutable();
        if ($doneDate < $hoy) {
            throw new InvalidArgumentException("La fecha de finalización de la reserva no puede ser antes de la fecha de hoy");
        }
        if ($doneDate < $this->getBookDate()) {
            throw new InvalidArgumentException("La fecha de finalización de la reserva no puede ser antes de su creación");
        }
        $this->doneDate = $doneDate;
    }

    public function getBookDate(): DateTimeImmutable
    {
        return $this->bookDate;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
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
            throw new InvalidArgumentException("La reserva ha de tener al menos 1 persona.");
        }

        $this->numPax = $numPax;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDoneDate(): DateTimeImmutable
    {
        return $this->doneDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

}

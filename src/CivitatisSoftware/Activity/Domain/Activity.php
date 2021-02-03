<?php

namespace App\CivitatisSoftware\Activity\Domain;

use DateTime;
use InvalidArgumentException;

final class Activity
{
    const MAX_TITLE_LENGTH = 64;
    const MAX_POPULARITY = 10;

    private int $id;
    protected string $title;
    protected string $description;
    protected Datetime $availabilityStartDate;
    protected Datetime $availabilityEndDate;
    protected float $pricePerPax;
    protected int $popularity;
    protected Datetime $createdAt;
    protected Datetime $updatedAt;

    public function __construct(int $id, string $title, string $description, DateTime $availabilityStartDate,
                                DateTime $availabilityEndDate, float $pricePerPax, int $popularity)
    {
        $this->id = $id;
        $this->setTitle($title);
        $this->description = $description;
        $this->setAvailabilityStartDate($availabilityStartDate);
        $this->setAvailabilityEndDate($availabilityEndDate);
        $this->setPricePerPax(floatval($pricePerPax));
        $this->setPopularity($popularity);
        $this->createdAt = new DateTime();
        $this->markAsUpdated();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    private function setTitle(string $title): void
    {
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            throw new InvalidArgumentException(sprintf("La longitud del título de esta actividad no debe exceder de %d caracteres", self::MAX_TITLE_LENGTH));
        }
        $this->title = $title;
    }

    /**
     * @return DateTime
     */
    public function getAvailabilityStartDate(): DateTime
    {
        return $this->availabilityStartDate;
    }


    /**
     * @param DateTime $availabilityStartDate
     */
    private function setAvailabilityStartDate(DateTime $availabilityStartDate): void
    {
        if (is_null($availabilityStartDate)) {
            throw new InvalidArgumentException("La fecha de comienzo debe tener un valor");
        }
        $hoy = new DateTime();
        if ($availabilityStartDate < $hoy) {
            throw new InvalidArgumentException("La fecha de comienzo de la actividad no puede ser anterior a hoy");
        }
        $this->availabilityStartDate = $availabilityStartDate;
    }

    /**
     * @return DateTime
     */
    public function getAvailabilityEndDate(): DateTime
    {
        return $this->availabilityEndDate;
    }

    /**
     * @param DateTime $availabilityEndDate
     */
    private function setAvailabilityEndDate(DateTime $availabilityEndDate): void
    {
        if (is_null($availabilityEndDate)) {
            throw new InvalidArgumentException("La fecha de final de la actividad debe tener un valor");
        }
        $availabilityStartDate = $this->getAvailabilityStartDate();
        if (!is_null($availabilityStartDate) && ($availabilityEndDate < $availabilityStartDate)) {
            throw new InvalidArgumentException("La fecha de final de la actividad no puede ser anterior a la de su comienzo");
        }
        $this->availabilityEndDate = $availabilityEndDate;
    }

    /**
     * @param float $pricePerPax
     */
    private function setPricePerPax(float $pricePerPax): void
    {
        if (!filter_var($pricePerPax, FILTER_VALIDATE_FLOAT)) {
            throw new InvalidArgumentException("El precio de la actividad debe estar reflejado con valores decimales (Ej. 34.0 €)");
        }
        if ($pricePerPax < 0) {
            throw new InvalidArgumentException("El precio de la actividad no puede ser negativo");
        }

        $this->pricePerPax = $pricePerPax;
    }

    /**
     * @param int $popularity
     */
    private function setPopularity(int $popularity): void
    {
        if ($popularity > self::MAX_POPULARITY) {
            throw new InvalidArgumentException(sprintf("La popularidad de la actividad no debe exceder de %d puntos", self::MAX_POPULARITY));
        }
        $this->popularity = $popularity;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * @return float
     */
    public function getPricePerPax(): float
    {
        return $this->pricePerPax;
    }

    /**
     * @return int
     */
    public function getPopularity(): int
    {
        return $this->popularity;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

}

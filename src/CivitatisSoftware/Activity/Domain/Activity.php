<?php

namespace App\CivitatisSoftware\Activity\Domain;

use DateTimeImmutable;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

final class Activity
{
    const MAX_TITLE_LENGTH = 64;
    const MAX_POPULARITY = 10;

    private int $id;
    protected string $title;
    protected string $description;
    protected DateTimeImmutable $availabilityStartDate;
    protected DateTimeImmutable $availabilityEndDate;
    protected float $pricePerPax;
    protected int $popularity;
    protected DateTimeImmutable $createdAt;
    protected DateTimeImmutable $updatedAt;

    public function __construct(int $id, string $title, string $description, DateTimeImmutable $availabilityStartDate,
                                DateTimeImmutable $availabilityEndDate, float $pricePerPax, int $popularity)
    {
        $this->id = $id;
        $this->setTitle($title);
        $this->description = $description;
        $this->setAvailabilityStartDate($availabilityStartDate);
        $this->setAvailabilityEndDate($availabilityEndDate);
        $this->setPricePerPax(floatval($pricePerPax));
        $this->setPopularity($popularity);
        $this->createdAt = new DateTimeImmutable();
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
     * @return DateTimeImmutable
     */
    public function getAvailabilityStartDate(): DateTimeImmutable
    {
        return $this->availabilityStartDate;
    }


    /**
     * @param DateTimeImmutable $availabilityStartDate
     */
    private function setAvailabilityStartDate(DateTimeImmutable $availabilityStartDate): void
    {
        if (is_null($availabilityStartDate)) {
            throw new InvalidArgumentException("La fecha de comienzo debe tener un valor");
        }
        $hoy = new DateTimeImmutable();
        if ($availabilityStartDate < $hoy) {
            throw new InvalidArgumentException("La fecha de comienzo de la actividad no puede ser anterior a hoy");
        }
        $this->availabilityStartDate = $availabilityStartDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getAvailabilityEndDate(): DateTimeImmutable
    {
        return $this->availabilityEndDate;
    }

    /**
     * @param DateTimeImmutable $availabilityEndDate
     */
    private function setAvailabilityEndDate(DateTimeImmutable $availabilityEndDate): void
    {
        if (is_null($availabilityEndDate)) {
            throw new InvalidArgumentException("La fecha de final de la actividad debe tener un valor");
        }
        $hoy = new DateTimeImmutable();
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
        $this->updatedAt = new DateTimeImmutable();
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

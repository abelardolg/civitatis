<?php

namespace App\CivitatisSoftware\Activity\Domain;

use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NonEmptyString;
use App\CivitatisSoftware\Shared\ValueObjects\Popularity;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateTime;
use InvalidArgumentException;

final class Activity
{
    const MAX_TITLE_LENGTH = 64;
    const MAX_POPULARITY = 10;

    private ID $id;
    private NonEmptyString $title;
    private NonEmptyString $description;
    private Datetime $availabilityStartDate;
    private Datetime $availabilityEndDate;
    private Price $pricePerPax;
    private Popularity $popularity;
    private Datetime $createdAt;
    private Datetime $updatedAt;

    public function __construct(ID $id, string $title, NonEmptyString $description, DateTime $availabilityStartDate,
                                DateTime $availabilityEndDate, Price $pricePerPax, Popularity $popularity)
    {
        $this->setID($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setAvailabilityStartDate($availabilityStartDate);
        $this->setAvailabilityEndDate($availabilityEndDate);
        $this->setPricePerPax($pricePerPax);
        $this->setPopularity($popularity);
        $this->createdAt = new DateTime();
        $this->markAsUpdated();
    }

    public function getId(): ?int
    {
        return $this->id->getValue();
    }

    private function setID(ID $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title->getValue();
    }

    public function setTitle(string $title): void
    {
        var_dump($title);
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            throw new InvalidArgumentException(sprintf('La longitud del título de esta actividad no debe exceder de %d caracteres', self::MAX_TITLE_LENGTH));
        }
        $this->title = new NonEmptyString($title);
    }

    public function getDescription(): string
    {
        return $this->description->getValue();
    }

    public function setDescription(NonEmptyString $description): void
    {
        $this->description = $description;
    }

    public function getPricePerPax(): float
    {
        return $this->pricePerPax->getValue();
    }

    private function setPricePerPax(Price $pricePerPax): void
    {
        $this->pricePerPax = $pricePerPax;
    }

    public function getPopularity(): int
    {
        return $this->popularity->getValue();
    }

    private function setPopularity(Popularity $popularity): void
    {
        $this->popularity = $popularity;
    }

    public function getAvailabilityStartDate(): DateTime
    {
        return $this->availabilityStartDate;
    }

    private function setAvailabilityStartDate(DateTime $availabilityStartDate): void
    {
        if (is_null($availabilityStartDate)) {
            throw new InvalidArgumentException('La fecha de comienzo debe tener un valor');
        }
        $hoy = new DateTime();
        if ($availabilityStartDate < $hoy) {
            throw new InvalidArgumentException('La fecha de comienzo de la actividad no puede ser anterior a hoy');
        }
        $this->availabilityStartDate = $availabilityStartDate;
    }

    public function getAvailabilityEndDate(): DateTime
    {
        return $this->availabilityEndDate;
    }

    private function setAvailabilityEndDate(DateTime $availabilityEndDate): void
    {
        if (is_null($availabilityEndDate)) {
            throw new InvalidArgumentException('La fecha de final de la actividad debe tener un valor');
        }
        $availabilityStartDate = $this->getAvailabilityStartDate();
        if (!is_null($availabilityStartDate) && ($availabilityEndDate < $availabilityStartDate)) {
            throw new InvalidArgumentException('La fecha de final de la actividad no puede ser anterior a la de su comienzo');
        }
        $this->availabilityEndDate = $availabilityEndDate;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTime();
    }
}

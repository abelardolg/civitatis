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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @return int
     */
    public function getNumPax(): int
    {
        return $this->numPax;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return array
     */
    public function getRelatedActivities(): array
    {
        return $this->relatedActivities;
    }

}

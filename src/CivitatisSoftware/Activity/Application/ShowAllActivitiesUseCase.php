<?php

namespace App\CivitatisSoftware\Activity\Application;

use App\CivitatisSoftware\Activity\Domain\Activity;
use App\CivitatisSoftware\Activity\Domain\ActivityList;
use App\CivitatisSoftware\Activity\Infrastructure\ActivityRepository;
use App\CivitatisSoftware\Shared\ComputeHelper;
use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NonEmptyString;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateTime;

final class ShowAllActivitiesUseCase
{
    private ActivityRepository $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * @return array|array[]
     */
    public function showAllActivitiesByDate(DateTime $date, int $numPax = 1): array
    {
        $activities = $this->activityRepository->findActivitiesInThisDate($date);

        return array_map(function (Activity $activity) use ($numPax) {
            $totalPrice = ComputeHelper::computeTotalPrice($activity->getPricePerPax(), $numPax);

//            public function __construct(ID $id, NonEmptyString $title, Price $totalPrice, NumPax $numPax)
            return new ActivityList(new ID($activity->getId()), new NonEmptyString($activity->getTitle()), new Price($totalPrice), new NumPax($numPax));
        }, $activities);
    }
}

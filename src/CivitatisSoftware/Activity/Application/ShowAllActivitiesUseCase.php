<?php

namespace App\CivitatisSoftware\Activity\Application;

use App\CivitatisSoftware\Activity\Domain\Activity;
use App\CivitatisSoftware\Activity\Domain\ActivityList;
use App\CivitatisSoftware\Activity\Infrastructure\ActivityRepository;
use App\CivitatisSoftware\Shared\ComputeHelper;
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

            return new ActivityList($activity->getId(), $activity->getTitle(), $totalPrice, $numPax);
        }, $activities);
    }
}

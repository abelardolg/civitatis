<?php


namespace App\CivitatisSoftware\Activity\Application;


use App\CivitatisSoftware\Activity\Infrastructure\ActivityRepository;
use DateTimeImmutable;

final class ShowAllActivitiesUseCase
{

    /**
     * @var ActivityRepository
     */
    private ActivityRepository $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function showAllActivitiesByDate(DateTimeImmutable $date, int $numPersonas)
    {
        $activities = $this->activityRepository->findActivitiesInThisDate($date);
        var_dump($activities);
    }
}

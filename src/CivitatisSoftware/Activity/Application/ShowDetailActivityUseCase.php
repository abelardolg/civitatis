<?php

namespace App\CivitatisSoftware\Activity\Application;

use App\CivitatisSoftware\Activity\Domain\ActivityDetail;
use App\CivitatisSoftware\Activity\Infrastructure\ActivityRepository;
use App\CivitatisSoftware\ActivityRelated\Domain\ActivityRelated;
use App\CivitatisSoftware\ActivityRelated\Infrastructure\ActivityRelatedRepository;
use App\CivitatisSoftware\Shared\ComputeHelper;

final class ShowDetailActivityUseCase
{
    private ActivityRepository $activityRepository;
    private ActivityRelatedRepository $activityRelatedRepository;

    public function __construct(ActivityRepository $activityRepository, ActivityRelatedRepository $activityRelatedRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->activityRelatedRepository = $activityRelatedRepository;
    }

    public function getDetailActivity(int $activityID, int $numPax): ?ActivityDetail
    {
        $activity = $this->activityRepository->findDetailActivityByID($activityID);
        $relatedActivities = $this->activityRelatedRepository->findRelatedActivitiesWithThisActivityID($activityID);
        if ($activity) {
            $relatedActivitiesForThisActivity = [];
            /**
             * @var ActivityRelated[] $relatedActivities
             */
            foreach ($relatedActivities as $relatedActivity) {
                $activityRelated = $this->activityRepository->findDetailActivityByID($relatedActivity->getIdRelatedActivity());
                $totalPrice = ComputeHelper::computeTotalPrice($activityRelated->getPricePerPax(), $numPax);
                array_push($relatedActivitiesForThisActivity,
                    new ActivityDetail(
                        $activityRelated->getTitle(), $activityRelated->getDescription(), $activityRelated->getAvailabilityStartDate(),
                        $totalPrice, $numPax, []
                    )
                );
            }

            $totalPrice = ComputeHelper::computeTotalPrice($activity->getPricePerPax(), $numPax);

            return new ActivityDetail(
                $activity->getTitle(), $activity->getDescription(), $activity->getAvailabilityStartDate(),
                $totalPrice, $numPax, $relatedActivitiesForThisActivity
            );
        }

        return null;
    }
}

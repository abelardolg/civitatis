<?php

namespace App\CivitatisSoftware\Activity\Application;

use App\CivitatisSoftware\Activity\Domain\ActivityDetail;
use App\CivitatisSoftware\Activity\Infrastructure\ActivityRepository;
use App\CivitatisSoftware\ActivityRelated\Domain\ActivityRelated;
use App\CivitatisSoftware\ActivityRelated\Infrastructure\ActivityRelatedRepository;
use App\CivitatisSoftware\Shared\ComputeHelper;
use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NonEmptyString;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;

final class ShowDetailActivityUseCase
{
    private ActivityRepository $activityRepository;
    private ActivityRelatedRepository $activityRelatedRepository;

    public function __construct(ActivityRepository $activityRepository, ActivityRelatedRepository $activityRelatedRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->activityRelatedRepository = $activityRelatedRepository;
    }

    public function getDetailActivity(ID $activityID, NumPax $numPax): ?ActivityDetail
    {
        $activity = $this->activityRepository->findDetailActivityByID($activityID);

        $relatedActivities = $this->activityRelatedRepository->findRelatedActivitiesWithThisActivityID($activityID->getValue());

        if ($activity) {
            $relatedActivitiesForThisActivity = [];
            /**
             * @var ActivityRelated[] $relatedActivities
             */
            foreach ($relatedActivities as $relatedActivity) {
                $activityRelated = $this->activityRepository->findDetailActivityByID($relatedActivity->getRelatedActivityID());
                $totalPrice = ComputeHelper::computeTotalPrice($activityRelated->getPricePerPax(), $numPax->getValue());
                array_push($relatedActivitiesForThisActivity,
                    new ActivityDetail(
                        new NonEmptyString($activityRelated->getTitle()), new NonEmptyString($activityRelated->getDescription()),
                        $activityRelated->getAvailabilityStartDate(), new Price($totalPrice), $numPax, []
                    )
                );
            }

            $totalPrice = ComputeHelper::computeTotalPrice($activity->getPricePerPax(), $numPax->getValue());

            return new ActivityDetail(
                new NonEmptyString($activity->getTitle()), new NonEmptyString($activity->getDescription()), $activity->getAvailabilityStartDate(),
                new Price($totalPrice), $numPax, $relatedActivitiesForThisActivity
            );
        }

        return null;
    }
}

<?php

namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Domain\Activity;
use App\CivitatisSoftware\Shared\BaseRepository;
use App\CivitatisSoftware\Shared\ValueObjects\ID;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ActivityRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Activity::class;
    }

    public function findActivitiesInThisDate(DateTime $activityDate): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('a');

        return $qb->from('App:Activity', 'a')
            ->where(':activityDate between a.availabilityStartDate and a.availabilityEndDate')
            ->setParameter('activityDate', $activityDate)
            ->orderBy('a.popularity', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findDetailActivityByID(ID $activityID): Activity
    {
        return $this->objectRepository->find($activityID);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Activity $activity): void
    {
        $this->saveEntity($activity);
    }
}

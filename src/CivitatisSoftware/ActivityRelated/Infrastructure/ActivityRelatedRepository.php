<?php

namespace App\CivitatisSoftware\ActivityRelated\Infrastructure;

use App\CivitatisSoftware\ActivityRelated\Domain\ActivityRelated;
use App\CivitatisSoftware\Shared\BaseRepository;

class ActivityRelatedRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return ActivityRelated::class;
    }

    public function findRelatedActivitiesWithThisActivityID(int $activityID): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('ar');

        return $qb->from('ActivityRelated:ActivityRelated', 'ar')
            ->where(':activityID = ar.mainActivityID')
            ->setParameter('activityID', $activityID)
            ->getQuery()
            ->getResult();
    }
}

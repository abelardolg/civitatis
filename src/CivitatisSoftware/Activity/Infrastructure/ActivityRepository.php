<?php


namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Domain\Activity;
use App\Tests\CivitatisSoftware\Activity\Domain\BaseRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ActivityRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Activity::class;
    }

    public static function createFindActivitiesInThisDateCriteria(DateTimeImmutable $activityDate): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->gte('availabilityStartDate', $activityDate))
            ->andWhere(Criteria::expr()->lte('availabilityEndDate', $activityDate))
            ->orderBy(['popularity' => 'DESC']);
    }

    public function findActivitiesInThisDate(DateTimeImmutable $activityDate): Criteria
    {
        return ActivityRepository::createFindActivitiesInThisDateCriteria($activityDate);
    }

    /**
     * @param Activity $activity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Activity $activity): void
    {
        $this->save($activity);
    }
}

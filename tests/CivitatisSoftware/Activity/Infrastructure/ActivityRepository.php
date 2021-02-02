<?php


namespace App\Tests\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Domain\Activity;
use App\Tests\CivitatisSoftware\Activity\Domain\BaseRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ActivityRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Activity::class;
    }

    public function findActivitiesInThisDate(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->gte('availabilityStartDate', true))
            ->andWhere(Criteria::expr()->lte('availabilityEndDate', true))
            ->orderBy(['popularity' => 'DESC']);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Activity $activity): void
    {
        $this->save($activity);
    }
}

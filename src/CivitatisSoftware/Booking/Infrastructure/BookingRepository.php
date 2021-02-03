<?php


namespace App\CivitatisSoftware\Booking\Infrastructure;

use App\CivitatisSoftware\Booking\Domain\Booking;
use App\CivitatisSoftware\Shared\BaseRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class BookingRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Booking::class;
    }

    /**
     * @param Booking $booking
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Booking $booking): void
    {
        $this->saveEntity($booking);
    }
}

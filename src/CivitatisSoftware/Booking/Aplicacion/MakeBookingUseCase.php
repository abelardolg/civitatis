<?php

namespace App\CivitatisSoftware\Booking\Aplicacion;

use App\CivitatisSoftware\Booking\Domain\Booking;
use App\CivitatisSoftware\Booking\Infrastructure\BookingRepository;
use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateInterval;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class MakeBookingUseCase
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function makeABooking(ID $activityID, NumPax $numPax, Price $totalPrice): void
    {
        $today = (new DateTime())->add(new DateInterval('P01D'));
        $doneDate = (new DateTime())->add(new DateInterval('P06D'));

        $booking = new Booking($activityID, $numPax, $totalPrice, $today, $doneDate);

        $this->bookingRepository->save($booking);
    }
}

<?php

namespace App\Tests\CivitatisSoftware\Booking\Domain;

use App\CivitatisSoftware\Booking\Domain\Booking;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;


class BookingTest extends TestCase
{
    const MAX_LENGTH = 64;
    private Booking $booking;

    public function setup(): void
    {
        $tomorrow = new DateTime('2021-02-06');
        $pastTomorrow = new DateTime('2021-02-07');

        $this->booking = new Booking(1, 1, 200.0, $tomorrow, $pastTomorrow);
    }

    public function testBookDateBeforeADate()
    {
        $aDate = new DateTimeImmutable('2021-02-03');
        $this->assertFalse($aDate > $this->booking->getBookDate(), "La fecha de la reserva no puede ser antes de hoy.");
    }

}

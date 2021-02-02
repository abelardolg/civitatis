<?php

namespace Tests\CivitatisSoftware;

use App\CivitatisSoftware\Booking\Domain\Booking;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;


class BookingTest extends TestCase
{
    const MAX_LENGTH = 64;
    private $booking;

    public function setup(): void
    {
        $tomorrow = new DateTimeImmutable('2021-02-03');
        $pastTomorrow = new DateTimeImmutable('2021-02-04');

        $this->booking = new Booking(1, 1, 1, 200.0, $tomorrow, $pastTomorrow);
    }

    public function testBookDateBeforeADate()
    {
        $aDate = new DateTimeImmutable('2021-02-03');
        $this->assertFalse($aDate > $this->booking->getBookDate(), "La fecha de la reserva no puede ser antes de hoy.");
    }

}

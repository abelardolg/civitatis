<?php


namespace App\Tests\CivitatisSoftware\Activity\Domain;


use App\CivitatisSoftware\Activity\Domain\Activity;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    private $activity;
    private $availabilityStartDate;
    private $availabilityEndDate;

    public function setup(): void
    {
        $this->availabilityStartDate = new DateTimeImmutable('2021-02-03');
        $this->availabilityEndDate = new DateTimeImmutable('2021-02-03');

        $this->activity = new Activity(1, $this->generateRandomString(Activity::MAX_TITLE_LENGTH), "description", $this->availabilityStartDate, $this->availabilityEndDate, 100.0, 4);
    }

    private function generateRandomString($length = Activity::MAX_TITLE_LENGTH)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function testSettingTitle()
    {
        $title = $this->generateRandomString();

        $this->activity = new Activity(1, $title, "description", $this->availabilityStartDate, $this->availabilityEndDate, 100.0, 4);

        $this->assertSame(Activity::MAX_TITLE_LENGTH, strlen($this->activity->getTitle()));
    }

    public function testSettingActivityStartDate()
    {
        $hoy = new DateTimeImmutable();
        $this->assertTrue($hoy <= $this->activity->getAvailabilityStartDate(), "La fecha de comienzo de la actividad es igual a hoy o superior");
    }

    public function testIfAvailabilityEndDateIsGreaterThanAvailabilityStartDate()
    {
        $this->assertTrue($this->activity->getAvailabilityStartDate() <= $this->activity->getAvailabilityEndDate(), "La fecha de comienzo de la actividad es igual o menor a la fecha final de la actividad");
    }

    public function testIfAvailabilityEndDateIsGreaterThanToday()
    {
        $today = new DateTimeImmutable();
        $this->assertTrue($today <= $this->activity->getAvailabilityEndDate(), "La fecha de final de la actividad es igual o mayor a la fecha de hoy");
    }

    public function testSettingNegativePricePerPax()
    {
        $price = 100.0;

        $this->activity = new Activity(1, $this->generateRandomString(Activity::MAX_TITLE_LENGTH), "description", $this->availabilityStartDate, $this->availabilityEndDate, $price, 4);

        $this->assertGreaterThan(0, $this->activity->getPricePerPax());
    }

    public function testSettingPopularity()
    {
        $popularity = Activity::MAX_POPULARITY;

        $this->activity = new Activity(1, "activityTitle", "activityDescription", $this->availabilityStartDate, $this->availabilityEndDate, 100.0, $popularity);

        $this->assertLessThanOrEqual(Activity::MAX_POPULARITY, $this->activity->getPopularity());
    }
}

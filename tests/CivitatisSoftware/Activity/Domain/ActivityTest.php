<?php


namespace App\Tests\CivitatisSoftware\Activity\Domain;


use App\CivitatisSoftware\Activity\Domain\Activity;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    const MAX_LENGTH = 64;
    private $activity;

    public function setup(): void
    {
        $inicio = new DateTimeImmutable('2021-02-03');
        $intervalo = new DateInterval('P1D');
        $fin = new DateTimeImmutable('2021-02-03');

        $periodoactivity = new DatePeriod($inicio, $intervalo, $fin);

        $this->activity = new Activity(1, $this->generateRandomString(activity::MAX_TITLE_LENGTH), "description", $periodoactivity, 100.0, 4);

    }

    private function generateRandomString($length = self::MAX_LENGTH)
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
        $inicio = new DateTimeImmutable('2021-02-03');
        $intervalo = new DateInterval('P1D');
        $fin = new DateTimeImmutable('2021-02-03');

        $activityAvailability = new DatePeriod($inicio, $intervalo, $fin);

        $this->activity = new Activity(1, $title, "description", $activityAvailability, 100.0, 4);
        $this->assertSame(self::MAX_LENGTH, strlen($this->activity->getTitle()));
    }

    public function testSettingActivityPeriod()
    {
        $hoy = new DateTimeImmutable();
        $this->assertTrue($hoy <= $this->activity->getAvailabilityDateRange()->getStartDate(), "La fecha de comienzo de la activity es igual a hoy o superior");
    }

    public function testSettingNegativePricePerPax()
    {
        $price = 100.0;

        $inicio = new DateTimeImmutable('2021-02-03');
        $intervalo = new DateInterval('P1D');
        $fin = new DateTimeImmutable('2021-02-03');
        $periodoactivity = new DatePeriod($inicio, $intervalo, $fin);
        $this->activity = new Activity(1, $this->generateRandomString(activity::MAX_TITLE_LENGTH), "description", $periodoactivity, $price, 4);

        $this->assertGreaterThan(0, $this->activity->getPricePerPax());
    }

    public function testSettingPopularity()
    {
        $popularity = Activity::MAX_POPULARITY;

        $inicio = new DateTimeImmutable('2021-02-03');
        $intervalo = new DateInterval('P1D');
        $fin = new DateTimeImmutable('2021-02-03');
        $periodoactivity = new DatePeriod($inicio, $intervalo, $fin);

        $this->activity = new Activity(1, "activityTitle", "activityDescription", $periodoactivity, 100.0, $popularity);

        $this->assertLessThanOrEqual(Activity::MAX_POPULARITY, $this->activity->getPopularity());
    }
}

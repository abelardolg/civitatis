<?php

namespace App\CivitatisSoftware\Shared;

use App\CivitatisSoftware\Shared\ValueObjects\ID;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use App\CivitatisSoftware\Shared\ValueObjects\Price;
use DateTime;
use Exception;

final class ValidationHelper
{
    public static function areValidShowActivitiesParameters(string $dateStr, int $numPax): bool
    {
        if (empty($dateStr)) {
            return false;
        }

        if (!isset($dateStr) || !isset($numPax)) {
            return false;
        }

        try {
            new DateTime($dateStr);
        } catch (Exception $e) {
            return false;
        }

        if ($numPax < 1) {
            return false;
        }

        return true;
    }

    /**
     * @param $activityID
     * @param $numPax
     * @param $totalPrice
     */
    public static function areValidMakeABookingParameters(ID $activityID, NumPax $numPax, Price $totalPrice): bool
    {
//        dd($activityID, $numPax, $totalPrice);
        if (!self::areValidActivityIDAndNumPax($activityID->getValue(), $numPax->getValue())) {
            return false;
        }
        if (!filter_var($totalPrice->getValue(), FILTER_VALIDATE_FLOAT)) {
            return false;
        }

        if (0 > $totalPrice->getValue()) {
            return false;
        }

        return true;
    }

    private static function areValidActivityIDAndNumPax(int $activityID, int $numPax): bool
    {
        if (!filter_var($activityID, FILTER_VALIDATE_INT)) {
            return false;
        }
        if (!filter_var($numPax, FILTER_VALIDATE_INT)) {
            return false;
        }

        if (0 > $activityID) {
            return false;
        }
        if (0 >= $numPax) {
            return false;
        }

        return true;
    }

    public static function areValidMakeDetailActivityParameters(int $activityID, int $numPax): bool
    {
        return self::areValidActivityIDAndNumPax($activityID, $numPax);
    }
}

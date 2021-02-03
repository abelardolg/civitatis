<?php


namespace App\CivitatisSoftware\Shared;

use DateTime;
use Exception;

final class ValidationHelper
{
    /**
     * @param string $dateStr
     * @param int $numPax
     * @return bool
     */
    public static function areValidShowActivitiesParameters(string $dateStr, int $numPax): bool
    {
        if (empty($dateStr)) return false;

        if (!isset($dateStr) || !isset($numPax)) return false;

        try {
            new DateTime ($dateStr);
        } catch (Exception $e) {
            return false;
        }

        if ($numPax < 1) return false;

        return true;
    }

    /**
     * @param $activityID
     * @param $numPax
     * @param $totalPrice
     * @return bool
     */
    public static function areValidMakeABookingParameters(int $activityID, int $numPax, float $totalPrice): bool
    {
        if (!self::areValidActivityIDAndNumPax($activityID, $numPax)) return false;
        if (!filter_var($totalPrice, FILTER_VALIDATE_FLOAT)) return false;

        if (0 > $totalPrice) return false;

        return true;
    }

    private static function areValidActivityIDAndNumPax(int $activityID, int $numPax): bool
    {
        if (!filter_var($activityID, FILTER_VALIDATE_INT)) return false;
        if (!filter_var($numPax, FILTER_VALIDATE_INT)) return false;

        if (0 > $activityID) return false;
        if (0 >= $numPax) return false;

        return true;
    }

    /**
     * @param int $activityID
     * @param int $numPax
     * @return bool
     */
    public static function areValidMakeDetailActivityParameters(int $activityID, int $numPax): bool
    {
        return self::areValidActivityIDAndNumPax($activityID, $numPax);
    }
}

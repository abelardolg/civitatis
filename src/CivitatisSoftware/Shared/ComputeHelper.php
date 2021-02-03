<?php

namespace App\CivitatisSoftware\Shared;

final class ComputeHelper
{
    public static function computeTotalPrice(float $price, int $numPax): float
    {
        return $price * floatval($numPax);
    }
}

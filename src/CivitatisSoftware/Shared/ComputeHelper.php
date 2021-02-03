<?php


namespace App\CivitatisSoftware\Shared;


final class ComputeHelper
{

    /**
     * @param float $price
     * @param int $numPax
     * @return float
     */
    static public function computeTotalPrice(float $price, int $numPax): float
    {
        return $price * floatval($numPax);
    }
}

<?php

namespace App\CivitatisSoftware\ActivityRelated\Domain;

final class ActivityRelated
{
    private int $idMainActivity;
    private int $idRelatedActivity;

    public function __construct(int $idMainActivity, int $idRelatedActivity)
    {
        $this->idMainActivity = $idMainActivity;
        $this->idRelatedActivity = $idRelatedActivity;
    }

    /**
     * @return int
     */
    public function getIdMainActivity(): int
    {
        return $this->idMainActivity;
    }

    /**
     * @return int
     */
    public function getIdRelatedActivity(): int
    {
        return $this->idRelatedActivity;
    }

}

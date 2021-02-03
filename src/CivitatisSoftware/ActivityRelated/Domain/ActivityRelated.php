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

    public function getIdMainActivity(): int
    {
        return $this->idMainActivity;
    }

    public function getIdRelatedActivity(): int
    {
        return $this->idRelatedActivity;
    }
}

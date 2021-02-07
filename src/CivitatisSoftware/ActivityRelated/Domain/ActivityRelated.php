<?php

namespace App\CivitatisSoftware\ActivityRelated\Domain;

use App\CivitatisSoftware\Shared\ValueObjects\ID;

class ActivityRelated
{
    private ID $mainActivityID;
    private ID $relatedActivityID;

    public function __construct(ID $mainActivityID, ID $relatedActivityID)
    {
        $this->setMainActivityID($mainActivityID);
        $this->setRelatedActivityID($relatedActivityID);
    }

    public function getMainActivityID(): ID
    {
        return $this->mainActivityID;
    }

    public function setMainActivityID(ID $mainActivityID): void
    {
        $this->mainActivityID = $mainActivityID;
    }

    public function getRelatedActivityID(): ID
    {
        return $this->relatedActivityID;
    }

    public function setRelatedActivityID(ID $relatedActivityID): void
    {
        $this->relatedActivityID = $relatedActivityID;
    }
}

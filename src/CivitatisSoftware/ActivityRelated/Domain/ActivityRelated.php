<?php

namespace App\CivitatisSoftware\ActivityRelated\Domain;

use App\CivitatisSoftware\Shared\ValueObjects\ID;

final class ActivityRelated
{
    private ID $mainActivityID;
    private ID $relatedActivityID;

    public function __construct(ID $mainActivityID, ID $relatedActivityID)
    {
        $this->setMainActivityID($mainActivityID);
        $this->setRelatedActivityID($relatedActivityID);
    }

    public function getMainActivityID(): int
    {
        return $this->mainActivityID->getValue();
    }

    public function setMainActivityID(ID $mainActivityID): void
    {
        $this->mainActivityID = $mainActivityID;
    }

    public function getRelatedActivityID(): int
    {
        return $this->relatedActivityID->getValue();
    }

    public function setRelatedActivityID(ID $relatedActivityID): void
    {
        $this->relatedActivityID = $relatedActivityID;
    }
}

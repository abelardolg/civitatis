<?php


namespace App\CivitatisSoftware\Shared\DTO;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTO
{

    public function __construct(Request $request);
}

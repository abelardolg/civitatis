<?php


namespace App\CivitatisSoftware\Shared\DTOs;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTO
{

    public function __construct(Request $request);
}

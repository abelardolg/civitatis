<?php


namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Shared\DTOs\RequestDTO;
use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;


final class ShowActivitiesRequest implements RequestDTO
{
    private string $date;

    private NumPax $numPax;

    public function __construct(Request $request)
    {
        $this->setDate($request->get("date"));
        $this->numPax = new NumPax($request->get("numPax"));
    }

    /**
     * @param string $date
     * @throws BadRequestException|Exception
     */
    private function setDate(string $date): void
    {
//        if (empty($date))
//        {
//            throw new BadRequestException("La fecha proporcionada no tiene el formato adecuado");
//        }


        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return NumPax
     */
    public function getNumPax(): NumPax
    {
        return $this->numPax;
    }

}

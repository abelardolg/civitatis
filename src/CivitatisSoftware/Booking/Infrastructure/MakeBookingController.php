<?php

namespace App\CivitatisSoftware\Booking\Infrastructure;

use App\CivitatisSoftware\Booking\Aplicacion\MakeBookingUseCase;
use App\CivitatisSoftware\Shared\ValidationHelper;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MakeBookingController extends AbstractController
{
    /**
     * @var MakeBookingUseCase
     */
    private MakeBookingUseCase $makeBookingUseCase;

    public function __construct(MakeBookingUseCase $makeBookingUseCase)
    {
        $this->makeBookingUseCase = $makeBookingUseCase;
    }

    public function __invoke(Request $request): Response
    {
        $activityID = $request->get("idActivity");
        $numPax = $request->get("numPax");
        $totalPrice = $request->get("totalPrice");

        if (!ValidationHelper::areValidMakeABookingParameters($activityID, $numPax, $totalPrice)) {
            return $this->render('activities/list_activities.html.twig', [
                "activities" => [],
                "msg" => "Por favor, proporcione los parámetros correctos.",
                "statusCode" => Response::HTTP_BAD_REQUEST
            ]);
        }

        try {
            $this->makeBookingUseCase->makeABooking($activityID, $numPax, $totalPrice);
            $msg = "La reserva se ha hecho satisfactoriamente. ¡Disfrute de su actividad y gracias por confiar en Civitatis!";
            $statusCode = Response::HTTP_OK;
        } catch (OptimisticLockException | ORMException $e) {
            $msg = "Hubo un problema en el servidor. Por favor, contacte con el administrador";
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->render('activities/list_activities.html.twig', [
            'activities' => [],
            "msg" => $msg,
            "statusCode" => $statusCode
        ]);

    }
}

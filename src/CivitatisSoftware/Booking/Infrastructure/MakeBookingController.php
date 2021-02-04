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
    private MakeBookingUseCase $makeBookingUseCase;

    public function __construct(MakeBookingUseCase $makeBookingUseCase)
    {
        $this->makeBookingUseCase = $makeBookingUseCase;
    }

    public function __invoke(Request $request): Response
    {
        $activityID = $request->get('idActivity');
        $numPax = $request->get('numPax');
        $totalPrice = $request->get('totalPrice');

        if (!ValidationHelper::areValidMakeABookingParameters($activityID, $numPax, $totalPrice)) {
            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => [],
                        'msg' => 'Por favor, proporcione los parámetros correctos.',
                        'statusCode' => Response::HTTP_BAD_REQUEST,
                        'type' => "danger"
                    ]
                ), Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->makeBookingUseCase->makeABooking($activityID, $numPax, $totalPrice);
            $msg = 'La reserva se ha hecho satisfactoriamente. ¡Disfrute de su actividad y gracias por confiar en Civitatis!';
            $statusCode = Response::HTTP_OK;
            $type = "success";
        } catch (OptimisticLockException | ORMException $e) {
            $msg = 'Hubo un problema en el servidor. Por favor, contacte con el administrador';
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $type = "danger";
        }

        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => [],
                    'msg' => $msg,
                    'statusCode' => $statusCode,
                    'type' => $type
                ]
            ), $statusCode);
    }
}

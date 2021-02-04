<?php

namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Application\ShowAllActivitiesUseCase;
use App\CivitatisSoftware\Shared\ValidationHelper;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowActivitiesController extends AbstractController
{
    private ShowAllActivitiesUseCase $showAllActivitiesUseCase;

    /**
     * ShowActivitiesController constructor.
     */
    public function __construct(ShowAllActivitiesUseCase $showAllActivitiesUseCase)
    {
        $this->showAllActivitiesUseCase = $showAllActivitiesUseCase;
    }

    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => [],
                    'msg' => '',
                    'statusCode' => -1,
                    'type' => ''
                ]
            ), Response::HTTP_OK);
    }

    public function returnActivitiesForThisDate(Request $request): Response
    {

        $msg = '';

        $dateStr = $request->get('date');
        $numPax = $request->get('quantity');

        if (!ValidationHelper::areValidShowActivitiesParameters($dateStr, intval($numPax))) {

            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => [],
                        'msg' => 'Por favor, proporcione los parámetros correctos.',
                        'statusCode' => Response::HTTP_BAD_REQUEST,
                        'type' => "danger"
                    ]
                ),
                Response::HTTP_BAD_REQUEST);
        }

        try {
            $date = new DateTime($dateStr);
            $activities = $this->showAllActivitiesUseCase->showAllActivitiesByDate($date, $numPax);
            $statusCode = empty($activities) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
            $type = empty($activities) ? "warning" : "success";

            if (empty($activities)) $msg = "Lo sentimos, no hay actividades programadas para esa fecha.";

            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => $activities,
                        'msg' => $msg,
                        'statusCode' => $statusCode,
                        "type" => $type
                    ]
                ), Response::HTTP_OK);
        } catch (Exception $e) {
            $msg = 'Hubo un error en el formato de los parámetros.';
            $statusCode = Response::HTTP_BAD_REQUEST;
            $activities = [];
            $type = "danger";
        }

        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => $activities,
                    'msg' => $msg,
                    'statusCode' => $statusCode,
                    'type' => $type
                ]
            ), $statusCode);
    }
}

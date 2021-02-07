<?php

namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Application\ShowAllActivitiesUseCase;
use App\CivitatisSoftware\Shared\ValidationHelper;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function __invoke(ShowActivitiesRequest $request): Response
    {
        $msg = '';

        $dateStr = $request->getDate();
        $numPax = $request->getNumPax();

        if (!ValidationHelper::areValidShowActivitiesParameters($dateStr, $numPax)) {
            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => [],
                        'msg' => 'Por favor, proporcione los parámetros correctos.',
                        'statusCode' => Response::HTTP_BAD_REQUEST,
                        'type' => 'danger',
                    ]
                ),
                Response::HTTP_BAD_REQUEST);
        }

        try {
            $activities = $this->showAllActivitiesUseCase->showAllActivitiesByDate(new DateTime($dateStr), $numPax);
            $statusCode = empty($activities) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
            $type = empty($activities) ? 'warning' : 'success';
            $msg = (empty($activities)) ? 'Lo sentimos, no hay actividades programadas para esa fecha.' : "";

            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => $activities,
                        'msg' => $msg,
                        'statusCode' => $statusCode,
                        'type' => $type,
                    ]
                ), Response::HTTP_OK);
        } catch (Exception $e) {
            $msg = $e->getMessage(); //'Hubo un error en el formato de los parámetros.';
            $statusCode = Response::HTTP_BAD_REQUEST;
            $activities = [];
            $type = 'danger';
        }

        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => $activities,
                    'msg' => $msg,
                    'statusCode' => $statusCode,
                    'type' => $type,
                ]
            ), $statusCode);
    }
}

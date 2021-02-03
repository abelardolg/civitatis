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
                    ]
                ),
                Response::HTTP_BAD_REQUEST);
        }

        try {
            $date = new DateTime($dateStr);
            $activities = $this->showAllActivitiesUseCase->showAllActivitiesByDate($date, $numPax);
            $statusCode = Response::HTTP_NO_CONTENT;
        } catch (Exception $e) {
            $msg = 'Hubo un error en el formato de los parámetros.';
            $statusCode = Response::HTTP_BAD_REQUEST;
            $activities = [];
        }

        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => $activities,
                    'msg' => $msg,
                    'statusCode' => $statusCode,
                ]
            ), $statusCode);
    }
}

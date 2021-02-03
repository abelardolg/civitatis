<?php

namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Application\ShowDetailActivityUseCase;
use App\CivitatisSoftware\Shared\ValidationHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowDetailActivityController extends AbstractController
{
    private ShowDetailActivityUseCase $showDetailActivityUseCase;

    /**
     * ShowDetailActivityController constructor.
     */
    public function __construct(ShowDetailActivityUseCase $showDetailActivityUseCase)
    {
        $this->showDetailActivityUseCase = $showDetailActivityUseCase;
    }

    public function returnDetailActivity(Request $request): Response
    {
        $activityID = $request->get('activityID');
        $numPax = $request->get('numPax');

        if (!ValidationHelper::areValidMakeDetailActivityParameters($activityID, $numPax)) {
            return new Response(
                $this->renderView('activities/list_activities.html.twig', [
                        'activities' => [],
                        'msg' => 'Por favor, proporcione los parámetros correctos.',
                        'statusCode' => Response::HTTP_BAD_REQUEST,
                    ]
                ), Response::HTTP_BAD_REQUEST);
        }

        $activity = $this->showDetailActivityUseCase->getDetailActivity($activityID, $numPax);

        if (!$activity) {
            return new Response(
                $this->renderView('activities/show_detail_activity.html.twig', [
                        'activity' => $activity,
                        'msg' => 'Lo sentimos, pero la actividad solicitada no se encuentra disponible.',
                        'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    ]
                ), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(
            $this->renderView('activities/show_detail_activity.html.twig', [
                    'activity' => $activity,
                    'msg' => '',
                    'statusCode' => Response::HTTP_OK,
                ]
            ), Response::HTTP_OK);
    }
}

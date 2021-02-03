<?php


namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Application\ShowDetailActivityUseCase;
use App\CivitatisSoftware\Shared\ValidationHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowDetailActivityController extends AbstractController
{

    /**
     * @var ShowDetailActivityUseCase
     */
    private ShowDetailActivityUseCase $showDetailActivityUseCase;

    public function __construct(ShowDetailActivityUseCase $showDetailActivityUseCase)
    {
        $this->showDetailActivityUseCase = $showDetailActivityUseCase;
    }

    public function returnDetailActivity(Request $request): Response
    {
        $activityID = $request->get("activityID");
        $numPax = $request->get("numPax");

        if (!ValidationHelper::areValidMakeDetailActivityParameters($activityID, $numPax)) {
            return $this->render('activities/list_activities.html.twig', [
                "activities" => [],
                "msg" => "Por favor, proporcione los parámetros correctos.",
                "statusCode" => Response::HTTP_BAD_REQUEST
            ]);
        }

        $activity = $this->showDetailActivityUseCase->getDetailActivity($activityID, $numPax);

        if (!$activity) {

            return $this->render('activities/show_detail_activity.html.twig', [
                "activity" => $activity,
                "relatedActivities" => $relatedActivities,
                "msg" => "Lo sentimos, pero la actividad solicitada no se encuentra disponible.",
                "statusCode" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return $this->render('activities/show_detail_activity.html.twig', [
            "activity" => $activity,
            "msg" => "",
            "statusCode" => Response::HTTP_OK
        ]);

    }

}
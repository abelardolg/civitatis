<?php


namespace App\CivitatisSoftware\Activity\Infrastructure;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowInitialPageActivity extends AbstractController
{
    public function __invoke(Request $request): Response
    {

        return new Response(
            $this->renderView('activities/list_activities.html.twig', [
                    'activities' => [],
                    'msg' => ($request->query->get("msg")) ?? $request->query->get("msg"),
                    'statusCode' => ($request->query->get("statusCode")) ? $request->query->get("statusCode") : -1,
                    'type' => ($request->query->get("type")) ?? $request->query->get("type")
                ]
            ), Response::HTTP_OK);
    }
}

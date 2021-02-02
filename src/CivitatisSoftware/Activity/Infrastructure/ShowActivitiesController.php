<?php


namespace App\CivitatisSoftware\Activity\Infrastructure;

use App\CivitatisSoftware\Activity\Application\ShowAllActivitiesUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ShowActivitiesController extends AbstractController
{

    /**
     * @var ShowAllActivitiesUseCase
     */
    private ShowAllActivitiesUseCase $showAllActivitiesUseCase;

    public function __construct(ShowAllActivitiesUseCase $showAllActivitiesUseCase)
    {
        $this->showAllActivitiesUseCase = $showAllActivitiesUseCase;
    }

    public function __invoke(Request $request)
    {
        var_dump($request);
    }

}

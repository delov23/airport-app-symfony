<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Route as RouteEntity;
use AppBundle\Form\RouteType;
use AppBundle\Service\Route\RouteServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/route")
 */
class RouteController extends BaseController
{
    /**
     * @var RouteServiceInterface
     */
    private $routeService;


    public function __construct(RouteServiceInterface $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * @Route("/create", name="route_create", methods={"GET"})
     *
     * @return Response
     */
    public function createView()
    {
        return $this->render('route/create.html.twig', $this->getFormArray(RouteType::class, new RouteEntity(), 'route'));
    }

    /**
     * @Route("/create", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request)
    {
        return $this->verifyEntity(RouteType::class, 'route', new RouteEntity(), $request, 'route/create.html.twig',
            function ($route) {
                $this->routeService->create($route);
            }
        );
    }
}

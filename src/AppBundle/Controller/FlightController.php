<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Flight;
use AppBundle\Form\FlightType;
use AppBundle\Service\Flight\FlightServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flight")
 */
class FlightController extends BaseController
{
    /**
     * @var RouteServiceInterface
     */
    private $routeService;

    /**
     * @var FlightServiceInterface
     */
    private $flightService;


    public function __construct(RouteServiceInterface $routeService, FlightServiceInterface $flightService)
    {
        $this->routeService = $routeService;
        $this->flightService = $flightService;
    }

    /**
     * @Route("/schedule/{type}", requirements={"type"="departures|arrivals"}, name="flight_schedule", methods={"GET"})
     *
     * @param $type string
     * @return Response
     */
    public function scheduleView($type)
    {
    }

    /**
     * @Route("/create", name="flight_create", methods={"GET"})
     *
     * @return Response
     */
    public function createView()
    {
        return $this->render('flight/create.html.twig',
            array_merge($this->getFormArray(FlightType::class, new Flight(), 'flight'), ['routes' => $this->routeService->getAll()]));
    }

    /**
     * @Route("/create", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request)
    {
        return $this->verifyEntity(FlightType::class, 'flight', new Flight(), $request, 'flight/create.html.twig',
            function ($flight) {
                $this->flightService->create($flight);
            }, 'index', ['routes' => $this->routeService->getAll()]);
    }
}

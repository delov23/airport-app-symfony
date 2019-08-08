<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Flight;
use AppBundle\Form\FlightType;
use AppBundle\Service\Flight\FlightServiceInterface;
use AppBundle\Service\Progress\ProgressServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

    /**
     * @var ProgressServiceInterface
     */
    private $progressService;


    public function __construct(RouteServiceInterface $routeService, FlightServiceInterface $flightService, ProgressServiceInterface $progressService)
    {
        $this->routeService = $routeService;
        $this->flightService = $flightService;
        $this->progressService = $progressService;
    }

    /**
     * @Route("/schedule", name="flight_schedule", methods={"GET"})
     *
     * @return Response
     */
    public function scheduleView()
    {
        return $this->render('flight/schedule.html.twig', [
            'departures' => $this->flightService->getByType('departures'),
            'arrivals' => $this->flightService->getByType('arrivals')
        ]);
    }

    /**
     * @Route("/create", name="flight_create", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
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
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request)
    {
        return $this->verifyEntity(FlightType::class, 'flight', new Flight(), $request, 'flight/create.html.twig',
            function (Flight $flight) {
                $flight->setProgress($this->progressService->getById(1));
                $this->flightService->create($flight);
            }, 'index', ['routes' => $this->routeService->getAll()]);
    }

    /**
     * @Route("/findOne", name="search_flight", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return Response
     */
    public function findOneRedirect(Request $request)
    {
        $flightNumber = $request->get('flight');
        $flights = $this->flightService->getByFlightNumber($flightNumber);
        if (!$flights || count($flights) === 0) {
            $this->addFlash('warning', 'No route with the flight number ' . $flightNumber);
            return $this->redirectToRoute('admin_panel');
        }
        return $this->render('flight/admin.html.twig', ['flights' => $flights]);
    }
}

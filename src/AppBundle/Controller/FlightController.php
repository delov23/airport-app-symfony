<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Flight;
use AppBundle\Entity\User;
use AppBundle\Form\FlightDetailsType;
use AppBundle\Form\FlightType;
use AppBundle\Service\Flight\FlightServiceInterface;
use AppBundle\Service\Progress\ProgressServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
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

    /**
     * @var UserServiceInterface
     */
    private $userService;


    public function __construct(RouteServiceInterface $routeService, FlightServiceInterface $flightService, ProgressServiceInterface $progressService, UserServiceInterface $userService)
    {
        $this->routeService = $routeService;
        $this->flightService = $flightService;
        $this->progressService = $progressService;
        $this->userService = $userService;
    }

    /**
     * @Route("/schedule", name="flight_schedule", methods={"GET"})
     *
     * @return Response
     */
    public function scheduleView()
    {
        $userFlights = $this->userService->getById($this->getUser()->getId())->getFlights()->toArray();
        return $this->render('flight/schedule.html.twig', [
            'departures' => $this->flightService->getByType('departures'),
            'arrivals' => $this->flightService->getByType('arrivals'),
            'flightIds' => array_map(function (Flight $flight) { return $flight->getId(); }, $userFlights),
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
     * @Route("/edit/{id}", name="flight_edit", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param $id
     * @return Response
     */
    public function editView($id)
    {
        $flight = $this->flightService->getById($id);
        return $this->render('flight/edit.html.twig', [
            'form' => $this->createForm(FlightDetailsType::class, $flight)->createView(),
            'flight' => $flight,
            'progressTypes' => $this->progressService->getAll()
        ]);
    }

    /**
     * @Route("/edit/{id}", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editProcess(Request $request, $id)
    {
        $flight = $this->flightService->getById($id);
        return $this->verifyEntity(FlightDetailsType::class, 'flight', $flight, $request, 'flight/edit.html.twig',
            function (Flight $flight) {
                $success = $this->flightService->edit($flight);
                if (!$success) {
                    $finalArray = array_merge($this->getFormArray(FlightDetailsType::class, $flight, 'flight'), ['errors' => ['seatsTaken' => 'The taken seats cannot be more than the seats on the flight.'], 'progressTypes' => $this->progressService->getAll()]);
                    return $this->render('flight/edit.html.twig', $finalArray);
                }
                return null;
            }, 'index', ['progressTypes' => $this->progressService->getAll()]);
    }

    /**
     * @Route("/route", name="search_flight", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return Response
     */
    public function findFlights(Request $request)
    {
        $flightNumber = $request->get('flight');
        $flights = $this->flightService->getByFlightNumber($flightNumber);
        if (!$flights || count($flights) === 0) {
            $this->addFlash('warning', 'No flights with the flight number "' . $flightNumber . '"');
            return $this->redirectToRoute('admin_panel');
        }
        return $this->render('flight/admin.html.twig', ['flights' => $flights]);
    }

    /**
     * @Route("/{id}", name="flight_details", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param int $id
     * @return Response
     */
    public function detailsView(int $id)
    {
        return $this->render('flight/details.html.twig', ['flight' => $this->flightService->getById($id)]);
    }

    /**
     * @Route("/remove/{id}", name="flight_remove", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param $id
     * @return Response
     */
    public function remove($id)
    {
        $flight = $this->flightService->getById($id);
        $this->flightService->remove($flight);
        return $this->redirectToRoute('search_flight', ['flight' => $flight->getRoute()->getFlightNumber()]);
    }

    /**
     * @Route("/star/{id}", name="flight_star", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function star(Request $request, $id)
    {
        /** @var User $user */
        $user = $this->getUser();
        $this->userService->toggleFlight($user, $this->flightService->getById($id));
        $view = $request->get('redirectView') ? $request->get('redirectView') : 'flight_schedule';
        return $this->redirectToRoute($view);
    }
}

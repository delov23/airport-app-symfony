<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flight")
 */
class FlightController extends BaseController
{
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
     * @param $type string
     * @return Response
     */
    public function createView($type)
    {
        return $this->render('flight/create.html.twig');
    }
}
